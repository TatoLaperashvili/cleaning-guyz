<div class="collaboration-div2">
    <h1>Let`s Collaborate</h1>
    <form action="">
        <input type="text" name="" id="" placeholder="{{ $collaborate_form->name }}">
        <input type="text" name="" id="" placeholder="{{ $collaborate_form->email }}">
        @foreach($collaborate_form->fields as $field)
         <div class="collaboration-rows">
            @if($field->type == 1)
            <input type="text" name="text" id="" placeholder="{{ $field->title }}">
            @endif
            @if($field->type == 8)
            <select name="answers[{{ $field->id }}]" id="" @if($field->validation['required'] == 1) required @endif>
                <option value="">select options</option>
                @foreach($field->data['options'] as $options)

                <option value="{{ $options }}">{{  $options  }}</option>
                @endforeach
            </select>
            @endif
            <div>
             
            </div>
            @if($field->type == 10)
            <div class="collaboration-row">
                <h3>{{ $field->title }}</h3>
                @foreach($field->data['options'] as $options)
                <div>
                    <input type="checkbox" id="checkbox1">
                    <label for="checkbox1">{{ $options }}</label>
                </div>
              @endforeach
            </div>
            @endif
            @if($field->type == 6)
            <div class="collaboration-row">
                <div>
                sdasd
                </div>
                <div class="colaboration-files">
                    <i class="icon-Vector-11"></i>
                    <label for="file1">{{ $field->title }}</label>
                    <input type="file" name="file" id="file1">
                </div>
              
            </div>
            @endif
            
        </div>
           @endforeach
        <div class="collaboration-row">
            <button>Contact</button>
        </div>
    </form>
    <div class=""></div>
</div>