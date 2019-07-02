@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
        系统设置
            <small>管理 > 股票类型</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    编辑 股票类型
                    </h2>
                </div>
                <div class="body">
                <form class="form-inline" action="/stocktype/update/{{$stocktype->id}}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="name">形式:</label>
                                <input type="text" class="form-control" id="option" placeholder="输入 名称" name="option" value="{{ $stocktype->option}}">
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="password">代  码:</label>
                                <input type="text" class="form-control" id="code" placeholder="输入  代  码" name="code" value="{{ $stocktype->code}}">
                            </div>
                        </div> 
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="repassword">名  称:</label>
                                <input type="text" class="form-control" id="cn_name" placeholder="输入 名  称" name="cn_name" value="{{ $stocktype->cn_name}}">
                            </div>
                        </div> 
                        <button type="submit" class="btn btn-default">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
