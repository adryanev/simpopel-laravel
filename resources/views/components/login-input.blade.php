  @props(['disabled'=>false])

  <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'intro-x login__input input input--lg']) !!}>
