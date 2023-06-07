<table class="table mb-0">
    <thead>
        <tr>
            <th>Title</th>
            @foreach($submission->additional as $key => $additional)
            <th>{{$key}}</th>
            @endforeach
            @if(isset($submissions->text))
            <th>{{trans('admin.text')}}</th>
                @endif
            
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        
       
        <tr>
            
            <th scope="row">{{$submission->post['en']->title}}</th>
            <th> <h5 style="font-weight: 400; line-height:20px"><b style="margin-right: 15px">{{trans('admin.name')}} :</b>
                {{ $submission->name}}</h5>
            </th>
            <th> <h5 style="font-weight: 400; line-height:20px"><b style="margin-right: 15px">{{trans('admin.email')}} :</b>
                {{ $submission->email}}</h5>
            </th>
            <th>
              
                @if(isset($submissions->text))
                <h5 style="font-weight: 400; line-height:20px"><b style="margin-right: 15px">{{trans('admin.text')}} :</b>
                    @endif
                    {{ $submission->text}}</h5>
            </th>
            <th>
                @foreach ($submission->additional as $key => $additional)
                @if($key == 'answers')
                @foreach($additional as $key1 => $answers)
                @if($key1 == 'title')
                <td>
                    <div class="chackbox">
                        
                        <div class="row chackbox-row">
                           
                            @foreach($answers as $checkbox_title => $checkbox_name)
                            <div class="col-sm-2">
                              
                                <h5 style="font-weight: 500; line-height:20px; margin-top:30px;">
                                    <b style="margin-right: 15px">{{ $checkbox_title }}:</b>
                                        @foreach($checkbox_name as $options_title => $options)
                                                    <p >{{ $options_title }}</p>
                                        @endforeach
                    
                                </h5>
                                
                            </div>
                            @endforeach
                        </div>   
                    </div>
                @elseif($key1 == 'file')
                 @if($answers > 0)
                @foreach($answers as $file_title => $file_name)
                <h5 style="font-weight: 500; line-height:20px; margin-top:30px;"><b style="margin-right: 15px">{{ $file_title }}:</b>
                        @foreach($file_name as $name)
                        <a href="/{{ config('config.file_path') . $name}}" target="_blank" style="color: black"> <span class="submission_files_name">  {{ $name }} </span></a>
                        @endforeach
    
                </h5>
               
                @endforeach
                @endif
    
                @else
                <h5 style="font-weight: 500; line-height:20px"><b style="margin-right: 15px">{{ $key1 }}:</b>
                    {{ $answers }}
                   
                </h5>
                         @endif
                       
                    @endforeach
                    @endif
                @endforeach
    
                </td>
              
            </th>
            <th scope="row">  {{ $submission->created_at->format('H:i - d.m.Y') }}</th>
           
        </tr>
    </tbody>
</table>
