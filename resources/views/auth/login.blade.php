{!! BootForm::open()->action('/auth/login') !!}
    {!! BootForm::email('Email', 'email')->hideLabel()->placeholder('Email') !!}
    {!! BootForm::password('Contraseña', 'password')->hideLabel()->placeholder('Contraseña') !!}
    {!! BootForm::checkbox('Recordarme en este dispositivo', 'remember') !!}
    {!! BootForm::submit('Acceder') !!}
{!! BootForm::close() !!}
