<?php


public function get_ratings() {
    if($this->data[$this->widget_id]) {
        echo json_encode($this->data[$this->widget_id]);
    }
    else {
        $data['widget_id'] = $this->widget_id;
        $data['number_votes'] = 0;
        $data['total_points'] = 0;
        $data['dec_avg'] = 0;
        $data['whole_avg'] = 0;
        echo json_encode($data);
    } 
}



public function vote() {
    # Get the value of the vote
    preg_match('/star_([1-5]{1})/', $_POST['clicked_on'], $match);
    $vote = $match[1];


$ID = $this->widget_id;
# Update the record if it exists
if($this->data[$ID]) {
    $this->data[$ID]['number_votes'] += 1;
    $this->data[$ID]['total_points'] += $vote;
}
# Create a new one if it does not
else {
    $this->data[$ID]['number_votes'] = 1;
    $this->data[$ID]['total_points'] = $vote;
}



?>