     <!-- Dialog popup container -->
     <div id="draginfopeta" class="dialog" style="width: 350px; display: none;">
        <h3 id="drag_title_peta" class="p-2 mb-0"></h3>
        <div class="card-body" id="feature-info" style="height: 150px; overflow: auto;"></div>
        <a href="{{ route('dataset')}}" class="btn btn-sm btn-secondary float-start mx-2">Detail</a>
        <button type="button" id="drag_close6" class="btn btn-sm btn-outline-dark mx-2 float-right mb-2">Close</button>
    </div>

    
 {{-- start basemap --}}
 <div id="menu-dataset" style="width:26%;">
    <div class="card radius-5">
        <div class="card-body card-body-map-popup-menu">
            <p class="card-title mb-1 d-flex justify-content-between fw-bold">Layer Dataset
                <button type="button" class="btn-close-map p-2" data-bs-dismiss="modal" aria-label="Close"
                    onclick="closeDataset()"></button>
            </p>
            <div class="row mb-2">
                <div class="col-md-12">
                    <ul class="nav nav-tabs float-end" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="layer-tab" data-bs-toggle="tab" data-bs-target="#layertab"
                                type="button" role="tab" aria-controls="layer" aria-selected="false">Layer
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="basemap-tab" data-bs-toggle="tab"
                                data-bs-target="#basemaptab" type="button" role="tab" aria-controls="basemap"
                                aria-selected="true">Basemap
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="layertab" role="tabpanel"
                aria-labelledby="layer-tab">
                <div class="container-layer">
                    <select id="density" name="density" class="select2 form-select" required>
                        <option value="#" selected>Select Density</option>
                        @foreach ($density_layer as $item)
                        <option value="{{$item->title}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-dark btn-sm float-end mt-2" onclick="clearMapDensity();">Clear</button>
                    <button class="btn btn-primary float-end btn-sm mt-2 mx-2" onclick="showMapDensity();">Map</button>
                    <div id="legend" class="leaflet-control"></div>
                    <div class="row mt-3">
                        <div class="col-md-5 p-0">
                            <p class="font-weight-bold text-dark mx-2 mb-0">Select Layer</p>
                        </div>
                        <div class="col-md-6 p-0">
                            <hr class="hr-style1">
                        </div>
                    </div>
                    <div class="row">
                    <div class="layer-list p-1 d-flex flex-wrap">
                        @foreach ($spatial_layer as $item)
                        <div class="cat action">
                           <label>
                              <input type="checkbox" id="{{$item->title}}"><span>{{$item->name}}</span>
                           </label>
                        </div>
                        @endforeach
                        
                        {{-- <div class="cat action">
                           <label>
                              <input type="checkbox" id="layer_bantuanSTB"><span>Bantuan STB</span>
                           </label>
                        </div> --}}
                        <div class="cat action">
                            <label>
                               <input type="checkbox" id="layer_penerimabantuan"><span>Bantuan Pelatihan</span>
                            </label>
                         </div>
                         <div class="cat action">
                            <label>
                               <input type="checkbox" id="layer_poi" checked><span>Point of Interest</span>
                            </label>
                         </div>
                         <div class="cat action">
                            <label>
                               <input type="checkbox" id="layer_prioritas"><span>Kawasan Prioritas</span>
                            </label>
                         </div>
                         {{-- <div class="cat action">
                            <label>
                               <input type="checkbox" id="layer_podes20"><span>Podes 2020</span>
                            </label>
                         </div> --}}
                         <div class="cat action">
                            <label>
                               <input type="checkbox" id="layer_spd"><span>Survey Potensi Desa</span>
                            </label>
                         </div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="tab-pane fade" id="basemaptab" role="tabpanel"
                    aria-labelledby="basemap-tab" style="max-height:300px; overflow:auto;">
                    <div class="container-basemap">
                        <form id="pilihbasemap">
                            <div class="option mb-2">
                                <input type="radio" name="card" id="earth" value="baseEsri">
                                <label for="earth" aria-label="Silver">
                                    <span></span>
                                    Esri Imagery
                                    <div class="card card--white card--sm p-1">
                                        <img src="{{ url('assets/images/basemap-icon/earth-base.png') }}"
                                            alt="earth-base">
                                    </div>
                                </label>
                            </div>
                            <div class="option mb-2">
                                <input type="radio" name="card" id="ocean" value="baseCarto1" checked>
                                <label for="ocean" aria-label="Silver">
                                    <span></span>
                                    Carto Gray
                                    <div class="card card--white card--sm p-1">
                                        <img src="{{ url('assets/images/basemap-icon/ocean-base.png') }}"
                                            alt="ocean-base">
                                    </div>
                                </label>
                            </div>
                            <div class="option mb-2">
                                <input type="radio" name="card" id="gearth" value="baseGoogle1">
                                <label for="gearth" aria-label="Silver">
                                    <span></span>
                                    Google Satellite
                                    <div class="card card--white card--sm p-1">
                                        <img src="{{ url('assets/images/basemap-icon/gearth-base.png') }}"
                                            alt="gearth-base">
                                    </div>
                                </label>
                            </div>
                            <div class="option mb-2">
                                <input type="radio" name="card" id="gstreet" value="baseGoogle2">
                                <label for="gstreet" aria-label="Silver">
                                    <span></span>
                                    Google Street
                                    <div class="card card--white card--sm p-1">
                                        <img src="{{ url('assets/images/basemap-icon/gstreet-base.png') }}"
                                            alt="gstreet-base">
                                    </div>
                                </label>
                            </div>
                            <div class="option mb-2">
                                <input type="radio" name="card" id="carto" value="baseCarto2">
                                <label for="carto" aria-label="Silver">
                                    <span></span>
                                    Carto Dark
                                    <div class="card card--blue card--sm p-1">
                                        <img src="{{ url('assets/images/basemap-icon/dark-base.png') }}"
                                            alt="dark-base">
                                    </div>
                                </label>
                            </div>
                            <div class="option mb-2">
                                <input type="radio" name="card" id="osm" value="baseOsm">
                                <label for="osm" aria-label="Silver">
                                    <span></span>
                                    OSM
                                    <div class="card card--dark card--sm p-1">
                                        <img src="{{ url('assets/images/basemap-icon/osm-base.png') }}" alt="osm-base">
                                    </div>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="layertab" role="tabpanel" aria-labelledby="layer-tab">
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end basemap --}}


 {{-- start legend --}}
 <div id="menu-legend" style="width:20%;">
    <div class="card radius-5">
        <div class="card-body card-body-map-popup-menu">
            <p class="card-title mb-1 d-flex justify-content-between fw-bold">Legend
                <button type="button" class="btn-close-map p-2" data-bs-dismiss="modal" aria-label="Close"
                    onclick="closeLegend()"></button>
            </p>
            <div id="legend-section">
                {{-- <div class="row mt-2" style="height:70px; overflow-y:auto;">
                    <div class="col-md-6 mb-2">
                        <div class="square" style="background:#0d324d;"></div> <span>Ket 1</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="square" style="background:#82b27d;"></div> <span>Ket 2</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="square" style="background: #ff9900;"></div> <span>Ket 3</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="square" style="background: #f87aa1;"></div> <span>Ket 4</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="dot" style="background: #9400d3;"></div> <span>Ket 5</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="dot" style="background: #01cdfe;"></div> <span>Ket 6</span>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
</div>
{{-- end legend --}}