@extends('layouts.body')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-info">
            <form class="form-inline" role="form" id="grid-search-form" onsubmit="return false;">
                <div class="form-group">
                    <input type="text" id="search-token-name"  class="form-control" placeholder="公众号AppId">
                </div>
                <button class="btn btn-info btn-sm"><i class="ace-icon fa fa-search"></i>搜索</button>
            </form>
        </div>
        <p class="pull-right" id="btns-type-one" >
            <button class="btn btn-white btn-success btn-bold" data-type="create" >
                <i class="ace-icon fa fa-cloud-upload bigger-120" ></i>发布新菜单
            </button>
            <button class="btn btn-white btn-success btn-bold" data-type="refresh" >
                <i class="ace-icon fa fa-undo bigger-120" ></i>刷新
            </button>
        </p>
    </div>
    <div class="col-xs-12">
        <div class="clearfix"><div class="pull-right tableTools-container"></div></div>
        <div class="table-header">微信 Access Token 授权列表</div>
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%;"></table>
        </div>
    </div>
</div>

<div id="dialog-message" class="hide" >
    <form class="form-horizontal" role="form" id="menu-form">
        <input type="hidden" id="fr-role-id"  value="0"  />
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="menu-name"> 角色名 </label>
            <div class="col-sm-9">
                <input type="text" id="fr-role-name"  placeholder="请填写角色名..." class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="form-field-1-4"> 角色名状态 </label>
            <div class="col-sm-9">
                <div class="radio">
                    <label>
                        <input name="fr-role-status" type="radio"  class="ace" checked="" value="1" />
                        <span class="lbl">启用</span>
                    </label>
                    <label>
                        <input name="fr-role-status" type="radio"  class="ace" value="0" />
                        <span class="lbl">禁用</span>
                    </label>
                </div>
            </div>
        </div>
</form>
</div>
@endsection

@push('scripts')
<script src="/ace-asstes/js/jquery.dataTables.min.js"></script>
<script src="/ace-asstes/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="/js/myTable.js"></script>
<script>
    var obj = {
        scrollX: true,
        columns: [
            {data:null,title:'<label class="pos-rel"><input type="checkbox" class="ace" /><span class="lbl"></span></label>',width:10,orderable:false,class:'table-checkbox',
                render:function(data){
                    return '<label class="pos-rel"><input type="checkbox" class="ace" value="' + data["id"] + '" /><span class="lbl"></span></label>';
                }
            },
            {title: '发布人',data: 'name',name:'name',orderable:false,width: 50},
            {title: '菜单数据',data: 'menu_json',name:'menu_json',orderable:false,width: 200,render: function ( data, type, row, meta ) {
                if(data.length > 150 ){


                    return "<a title='" + data+ "'>"+ data.slice(0,150) + "</a>";
                }else{
                    return data;
                }
            }},
            {title: '发布状态',data: 'status',name:'status',orderable:false,width: 100,render: function ( data, type, row, meta ) {
                if(data == 1){
                    return '<span  class="btn btn-white btn-yellow btn-sm">发布完成</span>';
                }else{
                    return '<span  class="btn btn-white btn-pink btn-sm">保存草稿</span>';
                }
            }},
            {title: '发布时间',data: 'updated_at',name:'updated_at',width: 100,orderable:false},
            {title: '添加时间',data: 'created_at',width: 150},
            {title: '操 作',data: 'id',orderable:false,width: 50,render: function ( data, type, row, meta ) {
                var str = '<button class="btn btn-minier btn-purple" onclick="objClass.edit(\''+meta.row+'\')"><i class="ace-icon fa fa-eye bigger-130"></i> 查看菜单数据</button>&nbsp;';
                return str;
            }}
            
        ],
    };
    
    var myTable = new MyTable('#dynamic-table',obj,"{{route('b_wechat_wechatmenudata')}}");
    myTable.init();
    
    $('#grid-search-form').on('submit',function(){
        objClass.refresh();
    });

    var objClass = {
        refresh:function(){
            var data = {
                appid:$.trim($('#search-token-name').val()),
            };
            myTable.setSearchParams(data);
            myTable.refresh();
        },
        create:function(){
            var edit_admin_role = layer.open({
                type: 2,
                maxmin: true,
                area: ['800px', '450px'],
                title: '<i class="ace-icon fa fa-cloud-upload bigger-120" ></i>&nbsp;发布新的微信公众号菜单',
                content: '{{route('b_wechat_createmenubox')}}',
                end:function(){
                  objClass.refresh();
                }
            });
            // layer.full(edit_admin_role);
        }
    };

    $('#btns-type-one > button').on('click',function(){
        objClass[$(this).data('type')]();
    });
    
    
</script>
@endpush