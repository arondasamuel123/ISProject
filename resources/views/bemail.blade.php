<!DOCTYPE html>
<html>
<head>
	<title>Accepted Bid- Student Gigs</title>

<div class="container">
    			
                Hello {{$user->name}},
                
                Congratulations, your bid was selected.
                You have been hired!!!
				
				Here are the milestones for this project as expected by the client:
				
					{{-- {{print_r($checklist)}} --}}
					@foreach ($checklist as $item)

			

<h2>{{ $item->milestone}}</h2>  <input disabled name="done"  type="checkbox" {{$item->done ? 'checked': ''}}/> <hr>
						
					@endforeach
				
                
                
              {{-- <a href="{{url('/gig/'.$client->client_id)}}">Click here to get started</a> --}}	
				Thank you for choosing Student Gigs.

    		    Regards, 
    		    Student Gigs Support 
    		
    		</div>

    	</head>

    	</html>