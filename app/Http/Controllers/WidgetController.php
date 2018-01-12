<?php

namespace App\Http\Controllers;

use App\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function createWidget() {
        $widgets = Widget::all();
        return view('admin.widgetCreate')->with('widgets' , $widgets);
    }

    public function storeWidget(Request $request) {
        Widget::create([
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'text' => $request->input('text'),
            'published' => $request->input('published'),
            'startPublished' => $request->input('startPublished'),
            'endPublished' => $request->input('endPublished'),
            'position' => $request->input('position'),
            'picture' => $request->hasFile('picture') ? $request->file('picture')->store('public/widget') : null,
            'link' => $request->input('link'),
            'showMobile' => $request->input('showMobile'),
        ]);
        flash()->success('Úspešne uložené!');
        return back();
    }

    public function destroyWidget($id) {
        $ads = Widget::findOrFail($id);
        \Storage::delete($ads->picture);
        $ads->delete();
        flash()->success('Úspešne Vymazané!');
        return back();
    }

    public function editWidget($id) {

        $widget = Widget::findOrFail($id);
        $widgets = Widget::all();

        return view('admin.widgetEdit')->with('widget', $widget)->with('widgets', $widgets);

    }

    public function updateWidget(Request $request, $id) {

        $widget = Widget::findOrFail($id);
        $widget->update($request->all());

        flash()->success('Úspečne aktualizované!');
        return back();

    }




}

