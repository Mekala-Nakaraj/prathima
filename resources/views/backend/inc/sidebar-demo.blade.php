{{-- Side bar --}}
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="index.html">
                    <img src="{{ asset('backend/assets/img/logo.png') }}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="index.html" class="nav-link"> Loan </a>
            </li>
        </ul>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="#dashboard" data-active="true" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-home"></i>
                        <span>Dashboards</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled collapse show" id="dashboard" data-parent="#accordionExample">
                    <li>
                        <a href="index.html"> Dashboard 1 </a>
                    </li>
                    <li class="active">
                        <a data-active="true" href="index-2.html"> Dashboard 2 </a>
                    </li>
                    <li>
                        <a href="index-3.html"> Dashboard 3 </a>
                    </li>
                    <li>
                        <a href="index-4.html"> Dashboard 4 </a>
                    </li>
                    <li>
                        <a href="index-5.html"> Dashboard 5 </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#app"  data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="lab la-medapps"></i>
                        <span>Apps</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                    <li>
                        <a href="apps_calendar.html"> Calendar </a>
                    </li>
                    <li>
                        <a href="apps_chat.html"> Chat </a>
                    </li>
                    <li>
                        <a href="#pages-companies" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Companies <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-companies" data-parent="#pages"> 
                            <li>
                                <a href="apps_companies.html"> List </a>
                            </li>
                            <li>
                                <a href="apps_company_details.html"> Company Details </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="apps_contacts.html"> Contacts </a>
                    </li>
                    <li>
                        <a href="#pages-ecommerce" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Ecommerce <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-ecommerce" data-parent="#pages"> 
                            <li>
                                <a href="apps_ecommerce.html"> Dashboard </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_products.html"> Products </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_product_details.html"> Product Details </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_add_product.html"> Add Product </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_orders.html"> Orders </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_order_details.html"> Order Details </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_customers.html"> Customers </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_sellers.html"> Sellers </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_cart.html"> Cart </a>
                            </li>
                            <li>
                                <a href="apps_ecommerce_checkout.html"> Checkout </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pages-email" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Email <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-email" data-parent="#pages"> 
                            <li>
                                <a href="apps_mail.html"> Inbox </a>
                            </li>
                            <li>
                                <a href="apps_mail_details.html"> Email Details </a>
                            </li>
                            <li>
                                <a href="apps_mail_create.html"> Compose Email </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="apps_file_manager.html"> File Manager </a>
                    </li>
                    <li>
                        <a href="apps_invoice.html"> Invoice List </a>
                    </li>
                    <li>
                        <a href="#pages-notes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Notes <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-notes" data-parent="#pages"> 
                            <li>
                                <a href="apps_notes.html"> List </a>
                            </li>
                            <li>
                                <a href="apps_notes_details.html"> Notes Details </a>
                            </li>
                            <li>
                                <a href="apps_notes_create.html"> Create Note </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="apps_social.html"> Social </a>
                    </li>
                    <li>
                        <a href="apps_taskList.html"> Task List </a>
                    </li>                            
                    <li>
                        <a href="#pages-error" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Tickets <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-error" data-parent="#pages"> 
                            <li>
                                <a href="apps_tickets.html"> Ticket List </a>
                            </li>
                            <li>
                                <a href="apps_ticket_details.html"> Ticket Details </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="menu-title">Pages</li>
            <li class="menu">
                <a href="#authentication" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-lock"></i>
                        <span>Auth Pages</span>
                    </div>
                    <div>
                        <!-- <i class="las la-angle-right sidemenu-right-icon"></i> -->
                        <span class="menu-badge badge-danger">New</span>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="authentication" data-parent="#accordionExample">
                    <li>
                        <a href="#pages-auth-one" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Type 1 <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-auth-one" data-parent="#pages"> 
                            <li>
                                <a href="auth_login_1.html"> Login</a>
                            </li>
                            <li>
                                <a href="auth_signup_1.html"> Register</a>
                            </li>
                            <li>
                                <a href="auth_lock_screen_1.html"> Lock Screen</a>
                            </li>
                            <li>
                                <a href="auth_forget_password_1.html"> Forget Password </a>
                            </li>
                            <li>
                                <a href="auth_confirm_email_1.html"> Confirm Email </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pages-auth-two" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Type 2 <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-auth-two" data-parent="#pages"> 
                            <li>
                                <a href="auth_login_2.html"> Login</a>
                            </li>
                            <li>
                                <a href="auth_signup_2.html"> Register</a>
                            </li>
                            <li>
                                <a href="auth_lock_screen_2.html"> Lock Screen</a>
                            </li>
                            <li>
                                <a href="auth_forget_password_2.html"> Forget Password </a>
                            </li>
                            <li>
                                <a href="auth_confirm_email_2.html"> Confirm Email </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#pages-auth-three" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Type 3 
                            <!-- <i class="las la-angle-right sidemenu-right-icon"></i>  -->
                            <span class="menu-badge badge-danger">New</span>
                        </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-auth-three" data-parent="#pages"> 
                            <li>
                                <a href="auth_login_3.html"> Login </a>
                            </li>
                            <li>
                                <a href="auth_signup_3.html"> Register </a>
                            </li>
                            <li>
                                <a href="auth_lock_screen_3.html"> Lock Screen </a>
                            </li>
                            <li>
                                <a href="auth_forget_password_3.html"> Forget Password </a>
                            </li>
                            <li>
                                <a href="auth_confirm_email_3.html"> Confirm Email </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-file"></i>
                        <span>Other Pages</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="pages" data-parent="#accordionExample">
                    <li>
                        <a href="pages_coming_soon.html"> Coming Soon </a>
                    </li>
                    <li>
                        <a href="pages_coming_soon_2.html"> Coming Soon 2</a>
                    </li>
                    <li>
                        <a href="pages_contact_us.html"> Contact Form </a>
                    </li>
                    <li>
                        <a href="pages_contact_us_2.html"> Contact Form 2</a>
                    </li>
                    <li>
                        <a href="#pages-error" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Error <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-error" data-parent="#pages"> 
                            <li>
                                <a href="pages_error404.html"> 404 </a>
                            </li>
                            <li>
                                <a href="pages_error500.html"> 500 </a>
                            </li>
                            <li>
                                <a href="pages_error503.html"> 503 </a>
                            </li>
                            <li>
                                <a href="pages_maintenance.html"> Maintenance </a>
                            </li>
                            <li>
                                <a href="pages_error404_2.html"> 404 Two</a>
                            </li>
                            <li>
                                <a href="pages_error500_2.html"> 500 Two </a>
                            </li>
                            <li>
                                <a href="pages_error503_2.html"> 503 Two </a>
                            </li>
                            <li>
                                <a href="pages_maintenance_2.html"> Maintenance Two </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages_faq.html"> FAQ </a>
                    </li>
                    <li>
                        <a href="pages_faq_2.html"> FAQ 2 </a>
                    </li>
                    <li>
                        <a href="pages_faq_3.html"> FAQ 3 </a>
                    </li>
                    <li>
                        <a href="pages_helpdesk.html"> Helpdesk </a>
                    </li>
                    <li>
                        <a href="pages_notifications.html"> Notifications </a>
                    </li>
                    <li>
                        <a href="pages_pricing.html"> Pricing </a>
                    </li>
                    <li>
                        <a href="pages_pricing_2.html"> Pricing 2</a>
                    </li>
                    <li>
                        <a href="pages_privacy_policy.html"> Privacy Policy </a>
                    </li>
                    <li>
                        <a href="pages_profile.html"> Profile </a>
                    </li>
                    <li>
                        <a href="pages_profile_edit.html"> Profile Edit </a>
                    </li>
                    <li>
                        <a href="pages_search_result.html"> Search Result </a>
                    </li>
                    <li>
                        <a href="pages_search_result_2.html"> Search Result 2</a>
                    </li>
                    <li>
                        <a href="pages_sitemap.html"> Sitemap </a>
                    </li>
                    <li>
                        <a href="pages_timeline.html"> Timeline </a>
                    </li>
                </ul>
            </li>
            <li class="menu-title">Components</li>
            <li class="menu">
                <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-drafting-compass"></i>
                        <span>Basic UI</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">
                    <li>
                        <a href="basic_ui_accordion.html"> Accordions  </a>
                    </li>
                    <li>
                        <a href="basic_ui_animation.html"> Animation </a>
                    </li>
                    <li>
                        <a href="basic_ui_cards.html"> Bootstrap Cards </a>
                    </li>
                    <li>
                        <a href="basic_ui_carousel.html">Carousel</a>
                    </li>
                    <li>
                        <a href="basic_ui_countdown.html"> Countdown </a>
                    </li>
                    <li>
                        <a href="basic_ui_counter.html"> Counter </a>
                    </li>
                    <li>
                        <a href="basic_ui_dragitems.html">Drag Items</a>
                    </li>
                    <li>
                        <a href="basic_ui_lightbox.html"> Lightbox </a>
                    </li>
                    <li>
                        <a href="basic_ui_lightbox_side_open.html"> Lightbox Side Open</a>
                    </li>
                    <li>
                        <a href="basic_ui_list_groups.html"> List Group </a>
                    </li>
                    <li>
                        <a href="basic_ui_media_object.html"> Media Object </a>
                    </li>
                    <li>
                        <a href="basic_ui_modals.html"> Modals </a>
                    </li> 
                    <li>
                        <a href="basic_ui_notifications.html"> Notifications </a>
                    </li>
                    <li>
                        <a href="basic_ui_scrollspy.html"> Scroll Spy </a>
                    </li>
                    <li>
                        <a href="basic_ui_session_timeout.html"> Session Timeout </a>
                    </li>
                    <li>
                        <a href="basic_ui_sweet_alerts.html"> Sweet Alerts </a>
                    </li>
                    <li>
                        <a href="basic_ui_tabs.html"> Tabs </a>
                    </li>
                    <li>
                        <a href="basic_ui_tour_tutorial.html"> Tour Tutorial </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="lab la-elementor"></i>
                        <span>UI Elements</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">
                    <li>
                        <a href="ui_elements_alerts.html"> Alerts </a>
                    </li>
                    <li>
                        <a href="ui_elements_avatar.html"> Avatar </a>
                    </li>
                    <li>
                        <a href="ui_elements_badges.html"> Badges </a>
                    </li>
                    <li>
                        <a href="ui_elements_breadcrumbs.html"> Breadcrumbs </a>
                    </li>                            
                    <li>
                        <a href="ui_elements_buttons.html"> Buttons </a>
                    </li>
                    <li>
                        <a href="ui_elements_colors.html"> Colors </a>
                    </li>
                    <li>
                        <a href="ui_elements_dropdowns.html"> Dropdown </a>
                    </li>
                    <li>
                        <a href="ui_elements_grid.html"> Grid </a>
                    </li>
                    <li>
                        <a href="ui_elements_jumbotron.html"> Jumbotron </a>
                    </li>
                    <li>
                        <a href="ui_elements_list_group.html"> List Group </a>
                    </li>
                    <li>
                        <a href="ui_elements_loading_spinners.html"> Loading Spinners </a>
                    </li>
                    <li>
                        <a href="ui_elements_pagination.html"> Pagination </a>
                    </li>
                    <li>
                        <a href="ui_elements_popovers.html"> Popovers </a>
                    </li>
                    <li>
                        <a href="ui_elements_progress_bar.html"> Progress Bar </a>
                    </li>
                    <li>
                        <a href="ui_elements_ribbons.html"> Ribbons </a>
                    </li>
                    <li>
                        <a href="ui_elements_tooltips.html"> Tooltips </a>
                    </li>
                    <li>
                        <a href="ui_elements_typography.html"> Typography </a>
                    </li>
                    <li>
                        <a href="ui_elements_video.html"> Video </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="widgets.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-desktop"></i>
                        <span>Widgets</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="tables.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-border-all"></i>
                        <span>Tables</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="datatables.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-table"></i>
                        <span>Datatables</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="lab la-wpforms"></i>
                        <span>Forms</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                    <li>
                        <a href="#form-control" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Controls <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="form-control" data-parent="#pages"> 
                            <li>
                                <a href="forms_controls_base_input.html"> Base Input </a>
                            </li>
                            <li>
                                <a href="forms_controls_input_groups.html"> Input Groups </a>
                            </li>
                            <li>
                                <a href="forms_controls_checkbox.html"> Checkbox </a>
                            </li>
                            <li>
                                <a href="forms_controls_radio.html"> Radio </a>
                            </li>
                            <li>
                                <a href="forms_controls_switch.html"> Switch </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#form-widget" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Widgets <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="form-widget" data-parent="#pages"> 
                            <li>
                                <a href="forms_widgets_picker.html"> Picker </a>
                            </li>
                            <li>
                                <a href="forms_widgets_tagify.html"> Tagify </a>
                            </li>
                            <li>
                                <a href="forms_widgets_touch_spin.html"> Touch Spin </a>
                            </li>
                            <li>
                                <a href="forms_widgets_maxlength.html"> Max Length </a>
                            </li>
                            <li>
                                <a href="forms_widgets_switch.html"> Switch </a>
                            </li>
                            <li>
                                <a href="forms_widgets_select_splitter.html"> Select Splitter</a>
                            </li>
                            <li>
                                <a href="forms_widgets_bootstrap_select.html"> Bootstrap Select </a>
                            </li>
                            <li>
                                <a href="forms_widgets_select_2.html"> Select 2 </a>
                            </li>
                            <li>
                                <a href="forms_widgets_input_masks.html"> Input Masks </a>
                            </li>
                            <li>
                                <a href="forms_widgets_autogrow.html"> Autogrow </a>
                            </li>
                            <li>
                                <a href="forms_widgets_range_slider.html"> Range Slider </a>
                            </li>
                            <li>
                                <a href="forms_widgets_clipboard.html"> Clipboard </a>
                            </li>
                            <li>
                                <a href="forms_widgets_typeahead.html"> Typeahead </a>
                            </li>
                            <li>
                                <a href="forms_widgets_captcha.html"> Captcha </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="forms_validation.html"> Validation </a>
                    </li>
                    <li>
                        <a href="forms_layouts.html"> Layouts </a>
                    </li>
                    <li>
                        <a href="forms_text_editor.html"> Text Editor </a>
                    </li>
                    <li>
                        <a href="forms_file_upload.html"> File Upload </a>
                    </li>
                    <li>
                        <a href="forms_multiple_step.html"> Multiple Step </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#maps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-globe-americas"></i>
                        <span>Maps</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="maps" data-parent="#accordionExample">
                    <li>
                        <a href="maps_leaflet_map.html"> Leaflet Map </a>
                    </li>
                    <li>
                        <a href="maps_vector_map.html"> Vector Map </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-chart-pie"></i>
                        <span>Charts</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="charts" data-parent="#accordionExample">
                    <li>
                        <a href="charts_apex_chart.html"> Apex Chart </a>
                    </li>
                    <li>
                        <a href="charts_chartlist.html"> Chartlist Charts </a>
                    </li>  
                    <li>
                        <a href="charts_chartjs.html"> ChartJS </a>
                    </li>
                    <li>
                        <a href="charts_morris_chart.html"> Morris Charts </a>
                    </li>                      
                </ul>
            </li>
            <li class="menu">
                <a href="#starter-kit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-copy"></i>
                        <span>Starter Kit</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="starter-kit" data-parent="#accordionExample">
                    <li>
                        <a href="starter_kit_blank_page.html"> Blank Page </a>
                    </li>
                    <li>
                        <a href="starter_kit_breadcrumbs.html"> Breadcrumbs </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#multi-level" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-sitemap"></i>
                        <span>Multi Level</span>
                    </div>
                    <div>
                        <i class="las la-angle-right sidemenu-right-icon"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="multi-level" data-parent="#accordionExample">
                    <li>
                        <a href="#level-two" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Level 2 <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="level-two" data-parent="#pages"> 
                            <li>
                                <a href="javascript:void(0)"> Link 1 </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"> Link 2 </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#level-three" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Level 3 <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="level-three" data-parent="#pages"> 
                            <li>
                                <a href="javascript:void(0)"> Link 1</a>
                            </li>
                            <li>
                                <a href="#level-four" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Link 2 <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                                <ul class="collapse list-unstyled sub-sub-submenu" id="level-four" data-parent="#pages"> 
                                    <li>
                                        <a href="javascript:void(0)"> Link 1</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"> Link 2 </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="menu-title">Others</li>
            <li class="menu">
                <a href="../../Docs/index.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-file-code"></i>
                        <span>Documentation</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>