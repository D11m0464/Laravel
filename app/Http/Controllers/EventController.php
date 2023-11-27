<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

use App\Models\User;

class EventController extends Controller
{
    //
    public function index(){
        $search=request('search');

        if($search){
            $events=Event::where([

                ['titulo','like','%'.$search.'%']

            ])->get();

        } else {

            $events= Event::all();

        }

        return view('welcome',['events'=>$events,'search'=>$search]); 
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $event=new Event;

        $event->titulo=$request->titulo;
        $event->data=$request->data;

        $event->cidade=$request->cidade;
        $event->privado=$request->privado;
        $event->descricao=$request->descricao;
        $event->items=$request->items;

        //Upload da Imagem
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;

        }

        $user=auth()->user();
        $event->user_id=$user->id;

        $event-> save();

        return redirect('/')->with('msg','Novo Evento criado com sucesso!!!');
    }

    public function show($id)
    {
        $event=Event::findOrfail($id);

        $user=auth()->user();

        $hasUserJoined=false;

        if ($user){

            $userEvents=$user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent){
                if($userEvent['id']==$id){
                    $hasUserJoined=true;
                }
            }
        }

        $eventOwner= User::where('id',$event->user_id)->first()->toArray();

        return view('events.show',['event'=>$event,'eventOwner'=>$eventOwner,'hasUserJoined'=>$hasUserJoined]);

    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant=$user->eventsAsParticipant;

        return view('events.dashboard', 
            ['events' => $events,'eventasparticipant'=>$eventsAsParticipant]
        );
    }

    public function destroy($id)
    {
           Event::findOrfail($id)->delete();

           return redirect('/dashboard')->with('msg','Evento Excluído com sucesso');

    }

    public function edit($id)
    {
        $user=auth()->user();
       
        $event=Event::findOrfail($id);

        if($user->id != $event->user_id)
        {

            return redirect('/dashboard');
        }

        return view('events.edit',['event'=>$event]);


    }


    public function update(Request $request){
        
        $data=$request->all();

        //Upload da Imagem
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image']=$imageName;

        }

        Event::findOrfail($request->id)->update($data);

        return redirect('/dashboard')->with('msg','Evento alterado com sucesso!');
    }

    public function joinEvent($id)
    {
        $user=auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event=Event::findOrFail($id);

        return redirect('/dashboard')->with('msg','Participação confirmada no Evento: '.$event->titulo);


    }

    public function leaveEvent($id)
    {
        $user=auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event=Event::findOrFail($id);

        return redirect('/dashboard')->with('msg','Participação excluida do Evento: '.$event->titulo);


    }


}
