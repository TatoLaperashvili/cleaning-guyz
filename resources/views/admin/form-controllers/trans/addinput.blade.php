<div class="form-group ">
    @if(isset($field['required']))
    <div id="req_input" class="datainputs">
        {{ Form::label($key,  trans('admin.'.$key),  ['class' => 'control-label iconify', 'data-icon' => "-" ,  'required' ]) }}
        {{ Form::text($locale.'['.$key.'][]',  null,   array_merge(  [  'required'  ] )) }}
        <span class="errtext"></span>
        <a  id="addmore" class="add_input">Add more</a>
    </div>
    @else
    @foreach($post->$locale->locale_additional[$key] as $Responsibilities)
    <div id="req_input" class="datainputs">
        
        {{ Form::label(strval($key) ,  trans('admin.'.$key),  ['class' => 'control-label iconify',   ]) }}
       
        {{ Form::text($locale.'['.$key.'][]', $Responsibilities, null) }}
       
        <span class="errtext"></span>
        <a  id="addmore" class="add_input">Add more</a>
    </div>
    @endforeach
    @endif

</div>
<style>
    [data-icon]:before {
        float: right;
        color: red;
        font-size: 24px;
    }

    .errtext {
        color: red;
    }

    .datainputs {
        margin-top: 20px;
    }

    .datainputs input {
        font-size: 18px;
        line-height: 21px;
        color: #3D3D3D;
        height: 50px;
        width: 50%;
        padding: 0px 20px;
        border-radius: 5px;
        border: 1px solid #ddd;
        box-shadow: 0px 0px 1px #D8D8D8;
        margin: 0px 30px 20px 0px !important;
    }

    input:focus {
        outline: none;
    }

    .add_input,
    .inputRemove {
        display: inline-block;
        color: #3d3d3d;
        text-align: center;
        text-decoration: none;
        width: auto;
        height: 40px;
        line-height: 40px;
        border: 2px solid #3d3d3d;
        padding: 0px 15px;
        border-radius: 5px;
    }

    .inputRemove {
        cursor: pointer;
    }

</style>
