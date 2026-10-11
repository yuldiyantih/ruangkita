<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $clients = Client::with([
            'user',
            'projects',
        ])
            ->whereHas('user', function ($query) use ($search, $status) {

                if ($search) {
                    $query->where(function ($q) use ($search) {

                        $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    });
                }

                if ($status === 'active') {
                    $query->where('is_active', true);
                }

                if ($status === 'inactive') {
                    $query->where('is_active', false);
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalClients = Client::count();

        $activeClients = Client::whereHas(
            'user',
            function ($query) {
                $query->where('is_active', true);
            }
        )->count();

        $inactiveClients = Client::whereHas(
            'user',
            function ($query) {
                $query->where('is_active', false);
            }
        )->count();

        $totalProjects = Client::withCount('projects')
            ->get()
            ->sum('projects_count');

        return view(
            'admin.clients.index',
            compact(
                'clients',
                'totalClients',
                'activeClients',
                'inactiveClients',
                'totalProjects',
                'search',
                'status'
            )
        );
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'client',
            'is_active' => true,
        ]);

        Client::create([
            'user_id' => $user->id,
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()
            ->route('admin.clients.index')
            ->with(
                'success',
                'Client berhasil ditambahkan.'
            );
    }

    public function show(Client $client)
    {
        $client->load([
            'user',
            'projects',
        ]);

        return view(
            'admin.clients.show',
            compact('client')
        );
    }

    public function edit(Client $client)
    {
        $client->load('user');

        return view(
            'admin.clients.edit',
            compact('client')
        );
    }

    public function update(
        Request $request,
        Client $client
    ) {
        $client->load('user');

        $user = $client->user;

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        $client->update([
            'address' => $validated['address'] ?? null,
        ]);

        return redirect()
            ->route('admin.clients.index')
            ->with(
                'success',
                'Data client berhasil diperbarui.'
            );
    }

    public function toggleStatus(Client $client)
    {
        $client->load('user');

        $user = $client->user;

        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        return redirect()
            ->route('admin.clients.index')
            ->with(
                'success',
                $user->is_active
                    ? 'Client berhasil diaktifkan.'
                    : 'Client berhasil dinonaktifkan.'
            );
    }
}
