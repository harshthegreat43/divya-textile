<select name="city" id="show_cities" class=" form-control" required>
                    <option value="">Select City</option>
                    @foreach($city as $cities)
                    <option value="{{$cities->id}}">{{ucwords(strtolower($cities->name))}}</option>
                    @endforeach
                </select>