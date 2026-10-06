<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PersonalFund;
use Illuminate\Http\Request;

class PersonalFundController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = PersonalFund::with([
            'expense',
            'user',
        ]);

        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $funds = $query
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $funds,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'expense_id' => 'required|exists:expenses,id|unique:personal_funds,expense_id',
            'amount' => 'required|numeric|min:0',
            'reimbursement_status' => 'nullable|in:unpaid,paid',
            'reimbursement_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = $user->id;

        $personalFund = PersonalFund::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dana pribadi berhasil dicatat.',
            'data' => $personalFund,
        ], 201);
    }

    public function show(Request $request, PersonalFund $personalFund)
    {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $personalFund->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses ke data dana pribadi ini.',
            ], 403);
        }

        $personalFund->load([
            'expense',
            'user',
        ]);

        return response()->json([
            'success' => true,
            'data' => $personalFund,
        ]);
    }

    public function update(
        Request $request,
        PersonalFund $personalFund
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $personalFund->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses untuk mengubah data ini.',
            ], 403);
        }

        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'reimbursement_status' => 'sometimes|in:unpaid,paid',
            'reimbursement_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $personalFund->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data dana pribadi berhasil diperbarui.',
            'data' => $personalFund->fresh(),
        ]);
    }

    public function destroy(
        Request $request,
        PersonalFund $personalFund
    ) {
        $user = $request->user();

        if (
            $user->role !== 'admin' &&
            $personalFund->user_id !== $user->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki akses untuk menghapus data ini.',
            ], 403);
        }

        $personalFund->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data dana pribadi berhasil dihapus.',
        ]);
    }
}
