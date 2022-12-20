<div class="media">
    <div class="media-body comment-body">
        <div class="row">
            @if ($item->is_student)
            <span class="comment-body-user">生徒側</span>
            @else 
            <span class="comment-body-user">講師側</span>
            @endif
            <span class="comment-body-time">{{$item->created_at}}</span>
        </div>
        <span class="comment-body-content">
            <div id="comment-data"></div>
            {{$item->content}}
        </span>
    </div>
  </div>
  
  
  
  