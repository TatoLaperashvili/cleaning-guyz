<table class="table mb-0">
    <caption>vacancy Submission</caption>
    <thead>
        <tr>
            <th >#</th>
            <th >Name</th>
            <th >Email</th>
            @if(isset($submissions->text))
            <th >text</th>
            @else
            <th></th>
            @endif
            @if(isset($submissions['additonal']->answers))
            <th>answers</th>
            @else
            <th></th>
            @endif
            <th>Posts Title</th>
            <th > Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($submissions as $key => $submission)
     
        <tr>
            
                <td scope="row">{{ $key + 1 }}</td>
                <td >
                    {{$submission->name}}
                </td>
    
                <td >
                    {{ $submission->email}}
                </td>
                @if(isset($submission->text))
                <td >
                    {{ $submission->text}}
                </td>
                @else
                <td>
                    
                </td>
                @endif
                @if(isset($submission['additional']['answers']))
                    {{-- @foreach($submission['additional']['answers'] as $key1 => $answers)
                       
                      
                <td>{{ $answers }}</td>
                @endforeach --}}
                @else
                <td></td>
                @endif
                @if(isset($submission->post))
                <td>
                    {{ $submission->post->translate()->title }}
                </td>
                @endif
                <td > {{ $submission->created_at->format('H:i - d.m.Y') }}</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
