<div class="media">
    <div class="media-body comment-body">
        <div class="row flex justify-center">
            @if ($item->is_student)
            <span class="comment-body-user bg-green-200 translate-x-10 mb-5 p-2">生徒側{{$item->created_at}}
                <br>
                {{$item->content}}
            </span>
            @else 
            <span class="comment-body-user bg-sky-200 -translate-x-10 mb-5 p-2">講師側{{$item->created_at}}
                <br>
                {{$item->content}}
            </span>
            @endif
            {{-- <span class="comment-body-time">{{$item->created_at}}</span> --}}
        </div>
        {{-- <span class="comment-body-content flex justify-center">
            <div id="comment-data"></div>
            {{$item->content}}
        </span> --}}
    </div>
  </div>
  
  
  
  