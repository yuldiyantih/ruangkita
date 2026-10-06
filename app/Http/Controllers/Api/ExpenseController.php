<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Expense::with(['project', 'material', 'creator']);

        if ($user->role !== 'admin') {
            $query->whereHas('project.client', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $expenses = $query
            ->latest('expense_date')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $expenses,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menambahkan pengeluaran.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'material_id' => 'nullable|exists:materials,id',
            'expense_date' => 'required|date',
            'store_name' => 'nullable|string|max:150',
            'category' => 'required|in:material,labor,transport,equipment,other',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'funding_source' => 'required|in:project,personal',
            'receipt_path' => 'nullable|string|max:255',
            'is_visible_to_client' => 'boolean',
        ]);

        $validated['created_by'] = $user->id;

        $expense = Expense::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pengeluaran berhasil ditambahkan.',
            'data' => $expense,
        ], 201);
    }

    public function show(Request $request, Expense $expense)
    {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $expense->project?->client?->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke pengeluaran ini.',
            ], 403);
        }

        $expense->load([
            'project',
            'material',
            'creator',
            'personalFund',
        ]);

        return response()->json([
            'success' => true,
            'data' => $expense,
        ]);
    }

    public function update(
        Request $request,
        Expense $expense
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat mengubah pengeluaran.',
            ], 403);
        }

        $validated = $request->validate([
            'project_id' => 'sometimes|exists:projects,id',
            'material_id' => 'nullable|exists:materials,id',
            'expense_date' => 'sometimes|date',
            'store_name' => 'nullable|string|max:150',
            'category' => 'sometimes|in:material,labor,transport,equipment,other',
            'description' => 'nullable|string',
            'amount' => 'sometimes|numeric|min:0',
            'funding_source' => 'sometimes|in:project,personal',
            'receipt_path' => 'nullable|string|max:255',
            'is_visible_to_client' => 'boolean',
        ]);

        $expense->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pengeluaran berhasil diperbarui.',
            'data' => $expense->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        Expense $expense
    ) {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya admin yang dapat menghapus pengeluaran.',
            ], 403);
        }

        $expense->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengeluaran berhasil dihapus.',
        ]);
    }
}
