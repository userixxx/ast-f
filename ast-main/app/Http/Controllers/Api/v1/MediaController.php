<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the media files.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::all();
        return response(['media' => $media], 200);
    }

    /**
     * Store a newly created media file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Проверяем, получен ли файл
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Генерируем уникальные значения для полей
            $modelId = Str::uuid();
            $uuid = Str::uuid();

            // Загружаем файл в хранилище
            $filePath = $file->store('media', 'public');

            // Создаем новый объект Media
            $media = Media::create([
                'model_type' => 'App\\Models\\Report',
                'model_id' => $modelId,
                'uuid' => $uuid,
                'collection_name' => 'reports',
                'name' => $file->getClientOriginalName(),
                'file_name' => $file->hashName(),
                'mime_type' => $file->getMimeType(),
                'disk' => 'public',
                'conversions_disk' => 'public',
                'size' => $file->getSize(),
                'manipulations' => [],
                'custom_properties' => [],
                'generated_conversions' => [],
                'responsive_images' => [],
                'order_column' => 0,
            ]);

            // Возвращаем созданный объект Media
            return response()->json($media);
        }

        // Если файл не был передан
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    /**
     * Update the specified media file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // ...

    /**
     * Update or create a media file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreate(Request $request, $id)
    {
        $media = Media::find($id);

        if (!$media) {
            $media = new Media();
            $media->id = $id;
        }
        $media->model_type = 'App\\Models\\Report';
        $media->model_id = $request->input('model_id', $media->model_id);
        $media->uuid = Str::uuid();
        $media->collection_name = $request->input('collection_name', $media->collection_name);
        $media->name = $request->input('name', $media->name);
        $media->file_name = $request->input('file_name', $media->file_name);
        $media->mime_type = $request->input('mime_type', $media->mime_type);
        $media->disk = $request->input('disk', $media->disk);
        $media->conversions_disk = $request->input('conversions_disk', $media->conversions_disk);
        $media->size = $request->input('size', $media->size);
        $media->manipulations = $request->input('manipulations', $media->manipulations);
        $media->custom_properties = $request->input('custom_properties', $media->custom_properties);
        $media->generated_conversions = $request->input('generated_conversions', $media->generated_conversions);
        $media->responsive_images = $request->input('responsive_images', $media->responsive_images);
        $media->order_column = $request->input('order_column', $media->order_column);
        $media->save();

        return response(['media' => $media], 200);
    }

    // ...

    /**
     * Download the specified media file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $media = Media::find($id);

        if ($media) {
            $filePath = Storage::disk('public')->path('media/' . $media->file_name);

            if (file_exists($filePath)) {
                $fileName = $media->name;
                $headers = [
                    'Content-Type' => $media->mime_type,
                ];

                return response()->download($filePath, $fileName, $headers);
            } else {
                return response(['error' => 'Медиафайл не найден в хранилище'], 404);
            }
        }

        return response(['error' => 'Медиафайл не найден'], 404);
    }


    /**
     * Remove the specified media file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::find($id);

        if ($media) {
            if (Storage::disk('public')->exists('media/' . $media->file_name)) {
                if (Storage::disk('public')->delete('media/' . $media->file_name)) {
                    $media->delete(); // Удаление записи из базы данных

                    return response(['message' => 'Медиафайл успешно удален'], 200);
                } else {
                    return response(['error' => 'Не удалось удалить медиафайл'], 500);
                }
            } else {
                return response(['error' => 'Медиафайл не найден в хранилище'], 404);
            }
        }

        return response(['error' => 'Медиафайл не найден'], 404);
    }
}
