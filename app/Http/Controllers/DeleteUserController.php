<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteUserController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->input('id');

        if (!$id) {
            return response()->json(['success' => false, 'error' => 'ID invàlid']);
        }

        try {
            DB::beginTransaction();

            // 1. Reasignar els articles abans d’eliminar
            DB::table('articles')->where('id_usuari', $id)->update(['id_usuari' => 13]);

            // 2. Eliminar l’usuari
            DB::table('usuaris')->where('id', $id)->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error eliminant usuari: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error intern: ' . $e->getMessage()
            ], 500);
        }
    }
}
