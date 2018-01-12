<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 20.12.2017
 * Time: 8:16
 */

namespace App\Services;

use Image;

class UploadFile
{
    public function saveFile($image, $model)
    {
        if(empty($image)) return false;

            $extension = $image->getClientOriginalExtension() ?: 'png';
            $filename = $model->slug . '.' . $extension;

            $type = strtolower(class_basename($model));

            $filepath = storage_path('app/public/'. $type. 's/' . $model->id);
            $image->move($filepath, $filename);


            switch ($type) {
                case 'user':
                    // Users resize
                    $this->resizeUser($filepath, $filename, $model);
                    break;

                case 'post':
                    // Posts resize
                    $this->resizePost($filepath, $filename, $model);
                    break;
                case 'event':
                    // Events resize
                    $this->resizeEvent($filepath, $filename, $model);
                    break;
                default:
                    return abort(503);
            }
    }

    public function resizePost($filepath, $filename, $model)
    {
        Image::make(file_get_contents($filepath . '/' . $filename))
            ->widen(900)->save($filepath . '/big-' . $filename);

        Image::make(file_get_contents($filepath . '/' . $filename))
            ->widen(250)->save($filepath . '/small-' . $filename);

        $model->update([
            'picture' => $filename,
        ]);
    }

    public function resizeUser($filepath, $filename, $model)
    {
        // Users resize
        Image::make(file_get_contents($filepath. '/' . $filename))
            ->widen(270)->save($filepath. '/' . $filename);

        Image::make(file_get_contents($filepath. '/' . $filename))
            ->widen(100)->save($filepath. '/small-' . $filename);

        $model->update([
            'avatar' => $filename,
        ]);
    }

    public function resizeEvent($filepath, $filename, $model)
    {
        // Events resize
        Image::make(file_get_contents($filepath . '/' . $filename))
            ->widen(1200)->save($filepath . '/big-' . $filename);

        Image::make(file_get_contents($filepath . '/' . $filename))
            ->widen(120)->save($filepath . '/small-' . $filename);

        $model->update([
            'picture' => $filename
        ]);
    }



    public function getVideoPicture($video, $post)
    {
        if (empty($video)) return;
        if (strlen(request('video_link')) > 12) {

            //Vybrat ID video z Youtube
            function getYouTubeIdFromURL($url)
            {
                $url_string = parse_url($url, PHP_URL_QUERY);
                parse_str($url_string, $args);
                return isset($args['v']) ? $args['v'] : false;
            }

            $videoId = getYouTubeIdFromURL(request('video_link'));
            \Storage::makeDirectory('public/posts/' . $post->id);

            Image::make('https://img.youtube.com/vi/' . $videoId . '/mqdefault.jpg')
                ->save(storage_path('app/public/posts/' . $post->id . '/' . $post->slug . '.jpg'));
            $post->update([
                'video_link' => $videoId
            ]);
        }
    }


    public function saveAppendFile($model)
    {
        if(request('appendFile')) {
            $appendFile = request()->file('appendFile')->store('public/events/' . $model->id);

            $model->update([
                'appendFile' => $appendFile
            ]);

        }
    }




}