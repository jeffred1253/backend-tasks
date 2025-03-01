<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Ajout d'une nouvelle tâche
    public function insert(Request $request) {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
        $request->validate([
            'titre' => 'required'
        ]);

        Task::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'echeance' => $request->echeance,
            'statue' => $request->statue,
            'user_id' => auth()->id
        ]);

        return response()->json(['message' => 'Nouvelle tâche ajoutée']);
    }

    // Mise à jour d'une tâche existante
    public function update(Request $request, $taskId) {
        try {
            $request->validate([
                'titre' => 'required'
            ]);
    
            $task = Task::find($taskId);
            $task->titre = $request->titre;
            $task->description = $request->description;
            $task->echeance = $request->echeance;
            $task->statue = $request->statue;
            $task->save();
    
            return response()->json(['message' => 'Tâche mise à jour']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // Suppression d'une tâche existante
    public function remove($taskId) {
        try {
            Task::find($taskId)->delete();
    
            return response()->json(['message' => 'Tâche supprimée']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // Liste des tâches par User
    public function indexByUser() {
        try {
            $tasks = Task::where('user_id', auth()->user()->id)->get();
    
            return response()->json($tasks);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    
    // Statistique des tâches de l'utilisateur connecté
    public function stats() {
        try {
            $tasks = Task::where('user_id', auth()->user()->id)->get();
    
            $attente = $tasks->where('statut', 'En attente')->count();
            $cours = $tasks->where('statut', 'En cours')->count();
            $termine = $tasks->where('statut', 'Terminé')->count();
            $total = $tasks->count();
    
            return response()->json([
                'attente' => $attente,
                'cours' => $cours,
                'termine' => $termine,
                'total' => $total,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
