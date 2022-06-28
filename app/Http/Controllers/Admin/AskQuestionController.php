<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Models\ReplyQuestion;
use App\Models\OrderAskQuestion;
use App\Models\AskQuestion;

use App\Mail\FirstEmail;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AskQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ask_question.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ask_question.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ask_question=AskQuestion::create([

                  "category_id"=> $request->category_id,
                  "question" => $request->question,
                  "price" => $request->price,
        ]);
        session()->flash('success','AskQuestion Added Succesfully');
        return redirect( route('ask_question.index') );
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_question=OrderAskQuestion::find($id);
        
        $order_question->status="Reply";
        $order_question->save();
        session()->flash('success','Order AskQuestion   Sucesfully Replied');
        return redirect()->back();
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ask_question=AskQuestion::find($id);
        return view('admin.ask_question.edit',compact('ask_question'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,AskQuestion $ask_question)
    {
        
        $ask_question->category_id=$request->category_id;
        $ask_question->question=$request->question;
        $ask_question->price=$request->price;
        $ask_question->save();
        session()->flash('success','categorys  sucesfully updated');
        return redirect( route('ask_question.index') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        $ask_question=AskQuestion::findorfail($id);
        $ask_question->delete();
        session()->flash('error','AskQuestion  sucesfully deleted');
        return redirect(route('ask_question.index'));
        //
    }



    public function reply_askquestion(Request $request,$id){ 

        $order_question=OrderAskQuestion::findorfail($id);
        $question=session()->get('question');
        $mails=session()->get('mail');
        $replies="";
        $question=[       
            'question'=>$request->question,
             ];
             $mails=[  
                $replies =[             
                    'question' => $request->question,
                    "reply"=> $request->reply,
                ]
              ];

        $reply=session()->get('reply');

        $reply=[       
            'answer'=>$request->reply,
             ];
            
      
        $min = min(count($question), count($reply));
        $keysOne = array_keys($question);
        $keysTwo= array_keys($reply);
         
       
        $question_id=$order_question->id;
       for($i = 0; $i < $min; $i++) {
         $reply_que= new  ReplyQuestion();
         $reply_que->orderquestion_id=$order_question->id;
         $reply_que->user_id=$reply_que->user_id;
         $reply_que->question=json_encode($question[$keysOne[$i]]);
          $reply_que->answer=json_encode($reply[$keysTwo[$i]]);
          $reply_que->save();
}
               $order_question->status=$request->status;
               $order_question->save();

                $data["email"] =$order_question->email;
                $data["mails"] =$mails;
                $data["question_id"] =$question_id;
                $data["title"]="helo";
    

            Mail::send('admin.Receipt.reply_question', $data, function($message)use($data) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"],$data["mails"]);
 
            
        });  
   
       session()->flash('success','Reply  has been sent succesfully');
       return redirect(route('order_question.index'));
           
    }

 


}
