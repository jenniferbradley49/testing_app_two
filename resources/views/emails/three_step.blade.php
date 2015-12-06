<!-- resources/views/emails/password.blade.php -->
The confidence message you entered was {!! $data['confidence_msg'] !!}
Click here to continue with the authorization process: {!! url('three_step/step_two'.$token) !!}	