<h2>Hi {{$user->name}}</h2>
<p>Your task <b>{{$task->title}}</b> is not completed yet, Due date <b>{{$task->due_date}}</b></p>
<p style="color:blue;"><b>Current status:</b> {{$task->status == 1 ? 'Todo' : 'In process'}}</p>
<p>{{$task->description}}</p>
<p style="color:{{$task->is_urgent == 1 ? 'red' : 'green'}};"><b>{{$task->is_urgent == 1 ? 'On-priority' : 'Non-priority'}}</b></p>
