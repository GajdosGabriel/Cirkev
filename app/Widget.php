<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Widget
 *
 * @mixin \Eloquent
 */
class Widget extends Model
{
    protected $guarded = ['id'];

    public function allWidget() {
        return Widget::all();
    }
}












//enctype="multipart/form-data"
//    accept="image/*"
//php artisan storage:link
//$path = $request->file('picture')->store('public');