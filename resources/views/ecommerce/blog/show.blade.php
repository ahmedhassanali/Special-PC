@extends('ecommerce.layouts.app')

@section('content')
<section class="page post bg-light-blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="post-thumb">
                            <img class="img-fluid full" loading="lazy" decoding="async" src="{{asset($post->photo)}}">
                            <div class="post-date">
                                <span class="post-date-day">
                                    19
                                </span>
                                <span class="post-date-month">
                                    May
                                </span>
                            </div>
                            <div class="post-cat">
                                <a href="#">Hardware</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="product-description">
                            <div class="post-content">
                                <div class="post-content-inner">
                                    <h3 class="text-dark">
                                         {{$post->title}}
                                    </h3>

                                    <p class="text-default">
                                       {!! $post->content !!}
                                    </p>

                                </div>
                                <div class="post-header">
                                    <div class="meta-author">
                                        <span>Posted by</span>
                                        <img src="{{asset('assets/ecommerce/img/blue-ghost.png')}}">
                                        <span>blue ghost</span>
                                    </div>

                                    <div class="post-actions">
                                        <div class="post-share">
                                            <div class="share">
                                                <div class="btn-group dropstart">
                                                    <a type="button" class="circle text-gray" data-bs-toggle="dropdown"
                                                        aria-expanded="false">

                                                        <svg id="Upload" width="20px" height="20px" viewBox="0 0 24 24"
                                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="Iconly/Light/Upload" stroke="none" stroke-width="1"
                                                                fill="none" fill-rule="evenodd" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <g id="Upload"
                                                                    transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) translate(2.000000, 2.000000)"
                                                                    stroke="#000000" stroke-width="1.5">
                                                                    <path
                                                                        d="M13.016,5.3895 L13.016,4.4565 C13.016,2.4215 11.366,0.7715 9.331,0.7715 L4.456,0.7715 C2.422,0.7715 0.772,2.4215 0.772,4.4565 L0.772,15.5865 C0.772,17.6215 2.422,19.2715 4.456,19.2715 L9.341,19.2715 C11.37,19.2715 13.016,17.6265 13.016,15.5975 L13.016,14.6545"
                                                                        id="Stroke-1"></path>
                                                                    <line x1="19.8095" y1="10.0214" x2="7.7685"
                                                                        y2="10.0214" id="Stroke-3"></line>
                                                                    <polyline id="Stroke-5"
                                                                        points="16.8812 7.1063 19.8092 10.0213 16.8812 12.9373">
                                                                    </polyline>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </a>
                                                    <ul class="dropdown-menu share-menu">
                                                        <li>
                                                            <a href="#" target="_blank">
                                                                <i class="fi fi-brands-facebook"></i> </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" target="_blank">
                                                                <i class="fi fi-brands-twitter-alt-square"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" target="_blank">
                                                                <i class="fi fi-brands-telegram"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" target="_blank">
                                                                <i class="fi fi-brands-whatsapp"></i>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="meta-reply">
                                            <a href="#" class="circle text-gray">
                                                <svg id="Chat" width="20px" height="20px" viewBox="0 0 24 24"
                                                    version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g id="Iconly/Light/Chat" stroke="none" stroke-width="1" fill="none"
                                                        fill-rule="evenodd" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <g id="Chat" transform="translate(2.000000, 2.000000)"
                                                            stroke="#000000">
                                                            <path
                                                                d="M17.0713569,17.0698633 C14.0152073,20.1263497 9.48977439,20.7866955 5.78641655,19.0740178 C5.23970647,18.8539025 4.7914846,18.6760012 4.36537232,18.6760012 C3.17848885,18.6830368 1.70116564,19.8338678 0.933359565,19.0669822 C0.165553489,18.2990915 1.3172626,16.8206004 1.3172626,15.6265504 C1.3172626,15.2003912 1.1464157,14.7601607 0.926324692,14.2123853 C-0.787169233,10.5096244 -0.125891225,5.98268764 2.93025835,2.92720636 C6.8315976,-0.975567922 13.1700176,-0.975567922 17.0713569,2.92620127 C20.979731,6.83500611 20.9726961,13.1680941 17.0713569,17.0698633 Z"
                                                                id="Stroke-4" stroke-width="1.5"></path>
                                                            <line x1="13.9394" y1="10.413" x2="13.9484" y2="10.413"
                                                                id="Stroke-11" stroke-width="2">
                                                            </line>
                                                            <line x1="9.9304" y1="10.413" x2="9.9394" y2="10.413"
                                                                id="Stroke-13" stroke-width="2">
                                                            </line>
                                                            <line x1="5.9214" y1="10.413" x2="5.9304" y2="10.413"
                                                                id="Stroke-15" stroke-width="2">
                                                            </line>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <span class="replies-count">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection