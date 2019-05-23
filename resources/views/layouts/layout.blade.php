<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyMemo</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
          rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous"
    >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    
    
    <!-- ソースコード表示 -->
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    

    @yield('script')
          
</head>
<body>

    
    
<!-- ナビゲーションバー -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="{{ url('') }}">Mymemo</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="ナビゲーションの切替">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="Navber">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('') }}">home <span class="sr-only">(現位置)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('posts.create') }}" class="btn btn-warning"><i class="fas fa-plus"></i>新規作成</a>
          </li>
        </ul>
        <div class="form-group">
            <form method="get" action="{{ url('') }}" class="form-inline my-2 my-lg-0">
                <input type="text" name="keyword" class="form-control mr-sm-2" value="" placeholder="検索キーワード">
            <button type="submit" class="btn btn-info my-2 my-sm-0"><i class="fas fa-search"></i>検索</button>
            </form>
        </div>        
      </div>
    </nav>
    
   
    
    
    <!-- サイドバー -->
    <div class="row" style="padding:10px 0 0 0">
    <div class="col-md-2">
        
         @if(count($lists) != 0)
        <div class="panel panel-default">
            
            <div class="panel-heading">
                　　タイトル一覧
            </div>
            @foreach ($lists as $post)
            <ul>
                <li>
                    <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a>
                </li>
            </ul>
            @endforeach
            
        </div>
        @endif
    </div>
    <div class="col-md-10">
        <div>
        
            
            
            
            @yield('content')
        </div> 
    </div>

</div><!-- container-fluid -->


 
    
       
 
    


  
    
</body>
</html>