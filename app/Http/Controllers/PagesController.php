<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapchaRequest;
use App\User;
use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{

    public function getIframeLink ($url,$loc) {
        $dom = HtmlDomParser::file_get_html($url);
        $elems = $dom->find('iframe');

       return ($elems[$loc]->attr ['src'] );

    }

    public function online() {

        $maranata = $this->getIframeLink('http://kmmaranata.sk/zive-vysielanie/',0);
        $milost_bb = $this->getIframeLink('http://www.milost.sk/live/',0);
        $milost_bratislava = $this->getIframeLink('http://bratislava.milost.sk/live/',0);
        $as_baptisti = $this->getIframeLink('http://bjbas.cz/clanky/live-streaming.html',0);
        $domViery = $this->getIframeLink('http://www.domviery.sk/live',0);


        return view('pages.online')->with('title', 'Živé prenosy')
            ->with('maranata', $maranata)
            ->with('milost_bb', $milost_bb)
            ->with('milost_bratislava', $milost_bratislava)
            ->with('as_baptisti', $as_baptisti)
            ->with('domViery', $domViery);

    }


    public function megabalik() {
        return view('pages.megabalik-krestanskych-knih')->with('title', 'Megabalík kresťanských kníh');
    }


    public function contact() {

        return view('pages.contact')
            ->with('title', 'Napíšte Správu!');


    }


    public function contact_store (CapchaRequest $request) {



        \Mail::send('emails.contact',
            array(
                'name' => $request->get('firstName'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
            {
                $message->from('admin@cirkevonline.sk');
                $message->to('gajdosgabo@gmail.com', 'Admin')->subject('Správa z Cirkev-Online.sk');
            });
        flash()->success('Správa bola odoslaná!');
        return redirect('/')->with('message', 'Správa bola odoslaná!');

    }










//    public function contactStoreUser (CapchaRequest $request, $id) {
//
//
//        $user = User::findOrFail($id);
//
//        \Mail::send('emails.contact-user',
//            array(
//                'name' => $request->get('name'),
//                'email' => $request->get('email'),
//                'user_message' => $request->get('message'),
//                'user_email' => $request->get('user-id'),
//
//            ), function($message) use ($user)
//            {
//                $message->from('admin@cirkevonline.sk', 'Cirkev-online');
//                $message->to($user->email, $user->name)->cc('gajdosgabo@gmail.com')->subject('Správa pre Cirkev-Online.sk');
//            });
//        flash()->success('Správa bola odoslaná!');
//        return redirect('/')->with('message', 'Správa bola odoslaná!');
//
//    }







}
