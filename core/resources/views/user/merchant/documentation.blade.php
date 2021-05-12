
@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">  
            <div class="col-lg-12">
                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0 text-dark">{{__('How to integerate button')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <pre class="merchant-documentation bg-dark">
                                <span class="text-primary">&lt;form</span> <span class="text-yellow">method=</span><span class="text-success">"POST"</span> <span class="text-yellow">action=</span><span class="text-success">"{{url('/')}}/ext_transfer"</span> <span class="text-primary">&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"merchant_key"</span> <span class="text-yellow">value=</span><span class="text-success">"MERCHANT KEY"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"success_url"</span> <span class="text-yellow">value=</span><span class="text-success">"//www.mydomain.com/success.html"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"fail_url"</span> <span class="text-yellow">value=</span><span class="text-success">"//www.mydomain.com/failed.html"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"amount"</span> <span class="text-yellow">value=</span><span class="text-success">"10000"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"email"</span> <span class="text-yellow">value=</span><span class="text-success">"user@test.com"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"first_name"</span> <span class="text-yellow">value=</span><span class="text-success">"Finn"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"last_name"</span> <span class="text-yellow">value=</span><span class="text-success">"Marshal"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"title"</span> <span class="text-yellow">value=</span><span class="text-success">"Payment For Item"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"description"</span> <span class="text-yellow">value=</span><span class="text-success">"Payment For Item"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"quantity"</span> <span class="text-yellow">value=</span><span class="text-success">"10"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">name=</span><span class="text-success">"currency"</span> <span class="text-yellow">value=</span><span class="text-success">"{{$currency->name}}"</span> <span class="text-primary">/&gt;</span>
                                <span class="ml-3 text-primary">&lt;input</span> <span class="text-yellow">type=</span><span class="text-success">"hidden"</span> <span class="text-yellow">value=</span><span class="text-success">"submit"</span> <span class="text-primary">/&gt;</span>
                                <span class="text-primary">&lt;/form&gt;</span>
                                </pre>  

                            <p class="text-sm text-dark mb-0"><button type="button" class="btn-icon-clipboard" data-clipboard-text='
                                <form method="POST" action="http://localhost/boompay/ext_transfer" >
                                <input type="hidden" name="merchant_key" value="MERCHANT KEY" />
                                <input type="hidden" name="success_url" value="//www.mydomain.com/success.html" />
                                <input type="hidden" name="fail_url" value="//www.mydomain.com/failed.html" />
                                <input type="hidden" name="amount" value="10000" />
                                <input type="hidden" name="email" value="user@test.com" />
                                <input type="hidden" name="first_name" value="Finn" />
                                <input type="hidden" name="last_name" value="Marshal" />
                                <input type="hidden" name="title" value="Payment For Item" />
                                <input type="hidden" name="description" value="Payment For Item" />
                                <input type="hidden" name="quantity" value="10" />
                                <input type="hidden" name="currency" value="NGN" />
                                <input type="hidden" value="submit" />
                                </form>' title="Copy code">{{__('Copy code')}}</button></p>                        
                            </div>
                        </div>
                    </div>
                </div>                

                <div class="card bg-white shadow">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0 text-dark">{{__('Requirements')}}</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush">
                            <thead class="">
                                <tr>
                                <th>{{__('S/N')}}</th>
                                <th>{{__('Value')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Required')}}</th>
                                </tr>
                            </thead>
                            <tbody>  
                                <tr>
                                    <td>{{__('1.')}}</td>
                                    <td>{{__('Merchant key')}}</td>
                                    <td>{{__('String')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                            
                                <tr>
                                    <td>{{__('2.')}}</td>
                                    <td>{{__('Success url')}}</td>
                                    <td>{{__('Url')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                            
                                <tr>
                                    <td>{{__('3.')}}</td>
                                    <td>{{__('Fail url')}}</td>
                                    <td>{{__('Url')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                                                                         
                                <tr>
                                    <td>{{__('5.')}}</td>
                                    <td>{{__('Amount')}}</td>
                                    <td>{{__('Int [Above 0.50 cents]')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                
                                <tr>
                                    <td>{{__('6.')}}</td>
                                    <td>{{__('Email')}}</td>
                                    <td>{{__('String')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                
                                <tr>
                                    <td>{{__('7.')}}</td>
                                    <td>{{__('First name')}}</td>
                                    <td>{{__('String')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                
                                <tr>
                                    <td>{{__('8.')}}</td>
                                    <td>{{__('Last name')}}</td>
                                    <td>{{__('String')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                
                                <tr>
                                    <td>{{__('9.')}}</td>
                                    <td>{{__('Title')}}</td>
                                    <td>{{__('String')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                
                                <tr>
                                    <td>{{__('10.')}}</td>
                                    <td>{{__('Description')}}</td>
                                    <td>{{__('String')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                
                                <tr>
                                    <td>{{__('11.')}}</td>
                                    <td>{{__('Currency')}}</td>
                                    <td>{{__('String')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>                                
                                <tr>
                                    <td>{{__('12.')}}</td>
                                    <td>{{__('Quantity')}}</td>
                                    <td>{{__('Int')}}</td>
                                    <td>{{__('Yes')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop