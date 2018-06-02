                    <div class="admin-sidebar-footer">
                        <div class="admin-sidebar-info">
                            <strong>Additional Actions</strong>

                            <ul>
                                @if($page == 'register' || $page == 'forgot-password' )
                                <li><a href="{{ route('customer.login',$locale) }}">Login</a></li>
                                @endif
                                @if($page == 'login' || $page == 'register')
                                <li><a href="{{ route('customer.register',$locale) }}">Register</a></li>
                                @endif
                                @if($page == 'login' || $page == 'forgot-password')
                                <li><a href="{{ route('customer.forgot-password',$locale) }}">Forgot Password</a></li>
                                @endif
                                <li><a href="#">Support</a></li>
                            </ul>
                        </div>
                        <!-- /.admin-landing -->

                        <p>
                            &copy; 2017 PINKHOMEDELIVERY - Online Advisering Platform. All rights reserved. <br /> Created by <a href="#">PINKHOMEDELIVERY</a>
                        </p>
                    </div>