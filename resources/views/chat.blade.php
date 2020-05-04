@extends('layouts.app')

@section('content')


<h2>Chat Room- Student Gigs </h2>
<div class="container">
    <div class="row" id="app">
        
        <div class="offset-4 col-4 offset-sm-1 col-sm-10">
        <ul class="list-group" v-chat-scroll>
        <li class="list-group-item active">Chat Room <span class="badge-pill badge-danger">@{{numberOfUsers}}</span> </li>
        <div class="badge float-left badge-success">@{{typing}}</div>
           <message-component v-for="value,index in chat.message" :key=value.index :color=chat.color[index] :user = chat.user[index] :time = chat.time[index]>
               @{{ value }}
           </message-component>
        </ul>
            <input   name="body"  class="form-control" placeholder="Type your message here...." v-model='message' @keyup.enter='send'>
            <br>
            <a href="" class="btn btn-warning btn-sm" @click.prevent='deleteSession'>Delete Chats</a>
            
          
    </div>
</div>
</div>


@endsection 