<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Candidate;
use App\Http\Resources\CandidateResource;

class ResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'position' => $this->position,
            'organizer' => $this->get_organizer($this->organizer_id),
            'candidates' => CandidateResource::collection(Candidate::where('voting_portal_id',$this->id)->get()),
        
            
          ];
    }
}
