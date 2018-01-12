<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 21.12.2017
 * Time: 14:00
 */

namespace app\Services;

use Illuminate\Database\Eloquent\Model;
use Image;

interface FileInterface
{
    public function storeFile($file, Model $model);
}
class FileService implements FileInterface
{
    private $file;
    private $model;
    private $resizeable;

    private $filename;
    private $path;

    public function storeFile($file, Model $model, Bool $resizeable = true)
    {
        if(empty($file)) return false;

        $this->file       = $file;
        $this->model      = $model;
        $this->resizeable = $resizeable;

        $this->filename   = $this->getFilename();
        $this->path       = $this->getFilePath();

        ($this->resizeable) ? $this->saveImage() : $this->saveFile();

        $this->updateDatabase();

        dd('prebehlo to');
    }

    private function getFilename()
    {
        $extension = $this->file->getClientOriginalExtension() ?: 'png';
        return sprintf('%s.%s', $this->model->slug, $extension);
    }

    private function getFilePath()
    {
        $model = strtolower(class_basename($this->model));
        return storage_path('app/public/'. $model. 's/' . $this->model->id);
    }

    private function saveImage()
    {
        // Save original image
        $this->saveFile();

        // Save resizing images
        switch (strtolower(class_basename($this->model))) {
            case 'user':
                $this->resizeImage(270, 'big');
                $this->resizeImage(100, 'small');
                break;
            case 'post':
                $this->resizeImage(900, 'big');
                $this->resizeImage(250, 'small');
                break;
            case 'event':
                $this->resizeImage(1200, 'big');
                $this->resizeImage(120, 'small');
                break;
            default:
                abort(503);
        }
    }

    private function resizeImage($width, $prefix)
    {
        $resizeImage    = Image::make($this->path . '/' . $this->filename)->widen($width);
        $resizeFilename = $this->path . '/' . $prefix . '-' . $this->filename;

        $this->saveFile($resizeImage, $resizeFilename);
    }

    private function saveFile($resize_file = null, $filename_with_prefix = null)
    {
        if ($resize_file) {
            $resize_file->save($filename_with_prefix);
        } else {
            $this->file->move($this->path, $this->filename);
        }
    }

    private function updateDatabase()
    {
        // toto este nefunguje .. ide to len pre posts, kde je stlpec picture
        $this->model->update([
            'picture' => $this->filename,
        ]);
    }
}