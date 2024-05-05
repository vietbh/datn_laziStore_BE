<div class="comment-form">
    @if (session('successComment'))
        <div 
        class="alert alert-success" role="alert">{{session('successComment')}}</div>
    @endif
    <h4 id="comment-reply">Để lại Bình luận</h4>
    <form class="form-contact comment_form" method="POST" action="{{ route('fe.comment.store') }}" enctype="multipart/form-data" id="commentForm">
        @csrf
        @method('post')
        @if (Auth::check()) <h6>{{Auth::user()->name}}</h6> @endif
        <input type="text" name="news_id" value="{{$detailNews->id}}" hidden>
        {{-- <input type="text" name="create_time" value="{{now()}}" hidden> --}}
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <textarea class="form-control w-100" name="content" id="comment" cols="30" rows="2" required
                        placeholder="Viết bình luận Comment"></textarea>
                </div>
            </div>
            @if (!Auth::check())
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control" name="name" id="name" required
                            type="text" placeholder="Name">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control" name="email" id="email" required
                            type="email" placeholder="Email">
                    </div>
                </div>
                
            @endif

        </div>
        <div class="form-group">
            <button type="submit" class="float-right btn-sm btn_1 boxed-btn">Bình luận</button>
        </div>
    </form>
</div>