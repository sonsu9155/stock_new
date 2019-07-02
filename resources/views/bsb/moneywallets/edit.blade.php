@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            钱帐户
            <small>证书 > <a href="{!! url('/moneywallets') !!}"> 钱帐户</a> > 编辑</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    手动入/扣款
                    </h2>
                </div>
                <div class="body">
               
                <form class="form-inline" action="/moneywallets/update" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="userid">操作类型:</label>
                                <select name="type">
                                    <option value="deposite">入款</option>
                                    <option value="deduction">扣款</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="userid">用户身份:</label>
                                <input type="text" class="form-control" id="userid"  name="userid" value="">
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="bill_type">代 理 商:</label>
                                <select name="bill_type" size="1" id="bill_type">
                                     <option value="recharge">充值</option>
                                     <option value="handling">手续费</option>
                                     <option value="floating">浮盈</option>
                                     <option value="other">其他</option>
                                     <option value="spread">点差费</option>
                                     <option value="slip">滑价修正</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="amount">发生金额:</label>
                                <input type="text" class="form-control" id="amount"  name="amount" placeholder="必须输入正数" value="">
                            </div>
                        </div> 
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="remark">备　　注:</label>
                                <textarea type="text" class="form-control" id="remark" cols="50" rows="8" name="remark"  value=""></textarea>
                            </div>
                        </div>     
                        <br/>
                        <br/>
                        <button type="submit" class="btn btn-default">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
