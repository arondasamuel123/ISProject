<style>
table, th, td {
    border: 1px solid black;
  }
  </style>
<h2>Requirements Completion Rate Report</h2>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Gig Name</th>
        <th scope="col">Milestone</th>
        <th scope="col">Completed?</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach ($checklists as $checklist)
        
    
      <tr>
         <td>{{\App\Gigs::where('gig_id', $checklist->gig_id)->pluck('gig_name')->first()}}</td>
        <td>{{$checklist->milestone}}</td>
        <td>{{$checklist->done}}</td>
      </tr>
        
      @endforeach
    </tbody>
  </table>
  <br>
  <br>
  <br>
<strong>Requirement completion rate:</strong> {{$percent}}%
