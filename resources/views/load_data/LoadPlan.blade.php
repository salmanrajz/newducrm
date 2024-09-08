@foreach($plan as $item)
    <option value="{{ $item->id }}"
        {{ $lead->plans == $item->id ? 'selected' : '' }}>
        {{ $item->plan_name }}</option>
@endforeach
