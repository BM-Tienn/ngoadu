<label class="switch2">
    <input class="switch-attractive" data-id="{{$data->id}}" type="checkbox" {{($data->priority == 1) ? 'checked' :''}}>
    <span class="slider round1"></span>
</label>

<style>
.switch2 {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 25px;
}

.switch2 input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.switch2 .slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50px;
}

.switch2 .slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50px;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

.switch2 input:checked + .slider:before {
  -webkit-transform: translateX(18px);
  -ms-transform: translateX(18px);
  transform: translateX(18px);
}

/* Rounded sliders */


.switch2 .slider.round:before {
  border-radius: 50%;
}
</style>