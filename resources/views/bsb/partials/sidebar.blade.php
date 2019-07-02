<aside id="leftsidebar" class="sidebar">
    <div class="user-info">
        <div class="image">
            <a href="/profile"><img src="/bsb/images/user.png" width="48" height="48" alt="User" /></a>
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {!! Auth::user()->name!!}
            </div>
            <div class="email">{!! Auth::user()->email !!}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{!! url('change_password') !!}">更改密码</a></li>
                    {{-- <li><a href="javascript:void(0);">轮廓</a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="javascript:void(0);">Followers</a></li>
                    <li><a href="javascript:void(0);">Sales</a></li>
                    <li><a href="javascript:void(0);">Likes</a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="javascript:void(0);">Sign Out</a></li> --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="menu">
        <ul class="list">
            <li class="header">主要导航</li>
            @if(Auth::user()->hasRole('superadministrator'))
            <li class="header">系统设置</li>
            <li class="{!! active_class(if_uri_pattern(['setting*']), 'active', '') !!}">
                <a href="/setting">
                   
                    <span>系统设置</span>
                </a>
            </li> 
            <li class="{!! active_class(if_uri_pattern(['stocktype*']), 'active', '') !!}">
                <a href="/stocktype">
                    
                    <span>股票型</span>
                </a>
            </li>
            <li class="header">用户管理</li>
            <li class="{!! active_class(if_uri_pattern(['users*']), 'active', '') !!}">
                <a href="/users">
                   
                    <span>用户</span>
                </a>
            </li>
            <li class="{!! active_class(if_uri_pattern(['onlineuser*']), 'active', '') !!}">
                <a href="/onlineuser">
                   
                    <span>在线用户</span>
                </a>
            </li>           
            <li class="{!! active_class(if_uri_pattern(['message*']), 'active', '') !!}">
                <a href="/message">
                    
                    <span>信息</span>
                </a>
            </li>  
            <li class="header">款项相关</li>
            <li class="{!! active_class(if_uri_pattern(['*edit']), 'active', '') !!}">
                <a href="/moneywallets/edit">
                
                    <span>手动入/扣款</span>
                </a>
            </li>
            <li class="{!! active_class(if_uri_pattern(['fundrequest*']), 'active', '') !!}">
                <a href="/fundrequest">
                
                    <span>入/出款需求</span>
                </a>
            </li>
            <li class="{!! active_class(if_uri_pattern(['moneywallets']), 'active', '') !!}">
                <a href="/moneywallets">
                
                    <span>资金明细</span>
                </a>
            </li>
            <li class="{!! active_class(if_uri_pattern(['deposithistory*']), 'active', '') !!}">
                <a href="/deposithistory">
                
                    <span>充值管理 </span>
                </a>
            </li>
            <li class="{!! active_class(if_uri_pattern(['withdrawhistory*']), 'active', '') !!}">
                <a href="/withdrawhistory">
                
                    <span>提款管理</span>
                </a>
            </li> 
            
            <li class="header">报表统计</li>

            <li class="{!! active_class(if_uri_pattern(['transactions/collection_forms*']), 'active', '') !!}">
                <a href="javascript:void(0);" class="menu-toggle {!! active_class(if_uri_pattern(['buyhistory*', 'sellhistory*']), 'toggled', '') !!}">
                    <span>买/卖</span>
                </a>
                <ul class="ml-menu">
                    <li class="{!! active_class(if_uri_pattern(['buyhistory*']), 'active', '') !!}">
                        <a href="/buyhistory">
                            <span>购买历史</span>
                        </a>
                    </li>
                    <li class="{!! active_class(if_uri_pattern(['sellhistory*']), 'active', '') !!}">
                        <a href="/sellhistory">
                            <span>卖历史</span>
                        </a>
                    </li>
                    
                </ul>
            </li>                       
           

            <li class="{!! active_class(if_uri_pattern(['stockgraph*']), 'active', '') !!}">
                <a href="/stockgraph">
                    
                    <span>股票图</span>
                </a>
            </li>

            <li class="{!! active_class(if_uri_pattern(['news*']), 'active', '') !!}">
                <a href="/news">                    
                    <span>新闻</span>
                </a>
            </li>

            @endif         
        </ul>
    </div>
    <div class="legal">
        <div class="copyright">
            &copy; <?php echo date('Y'); ?> <a href="javascript:void(0);">管理员</a>.
        </div>
        <div class="version">
            <b>版: </b> 1.0.0
        </div>
    </div>
 
</aside>
