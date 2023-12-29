<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ExtractedTextController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function extractText(Request $request){
        $user = Auth::user();
        $maxFileSize = $user && $user->subscribed() ? 15360 : 3072;
        $maxFilesCount = $user && $user->subscribed() ? 30 : 3;


        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:'. $maxFileSize, // Aquí se define la validación
        ]);
        
        $images = $request->file('images');
        if(count($images) > $maxFilesCount){
            return response()->json(['message' => 'No puedes subir más de ' . $maxFilesCount . ' imágenes.'], 422);
        }


        $results= [];
        $contador = 0;
    
        foreach($images as $image){
            try {
                // Ruta del script de python
                $pythonScriptPath = base_path('scripts/ocr_script.py');
                $imagePath = $image->getPathName();

                // Crear y ejecutar el proceso de python
                $process = new Process(['python3', $pythonScriptPath, $imagePath]);
                $process->setEnv($_SERVER);
                $process->run();

                // Verificar si el proceso fue exitoso
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                // Obtener el texto extraído de la imagen
                $text = $process->getOutput();

                if(empty(trim($text))){
                    $text = "No pudimos encontrar texto en su imagen.";
                }
            } catch (\Exception $exception) {
                $text = "No pudimos encontrar texto en su imagen.";
            }

                
            
            $imageIdentifier = "imagen-" . $contador++;

            $results[] = [ 'id' => $image->getClientOriginalName(), 'text' => $text, 'image' => $image->getClientOriginalName()
            ];
            
            // Eliminar la imagen del servidor
            if(file_exists($imagePath)){
                unlink($imagePath);
            }

      
        }
    
        return response()->json($results);
    }
    
};