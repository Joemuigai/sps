@extends('emails.layout.email_index')

@section('content')
    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation"
        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
        <tbody>
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 600px;" width="600">
                        <tbody>
                            <tr>
                                <td class="column column-1"
                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; border-bottom: 19px solid transparent; border-left: 19px solid transparent; border-right: 19px solid transparent; border-top: 19px solid transparent; padding-bottom: 5px; padding-top: 5px; vertical-align: top;"
                                    width="100%">
                                    <table border="0" cellpadding="10" cellspacing="0" class="text_block block-1"
                                        role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                        width="100%">
                                        <tr>
                                            <td class="pad">
                                                <div style="font-family: sans-serif">
                                                    <div class=""
                                                        style="font-size: 12px; font-family: Arial, Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                        <p
                                                            style="margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 19.2px;">
                                                            <strong>SU SMART PARKING SYSTEM</strong>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="10" cellspacing="0" class="divider_block block-2"
                                        role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                        width="100%">
                                        <tr>
                                            <td class="pad">
                                                <div align="center" class="alignment">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="divider_inner"
                                                                style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                <span> </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="10" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                        <tr>
                                          <td class="pad">
                                            <div style="font-family: sans-serif">
                                              <p style="margin: 0; font-size: 14px; text-align: center; font-family: Arial, Helvetica, sans-serif; color: #555555; line-height: 1.2;">
                                                Hello {{ $user->first_name .' ' .$user->last_name}},
                                              </p>
                                              <p style="margin: 0; font-size: 14px; text-align: center; font-family: Arial, Helvetica, sans-serif; color: #555555; line-height: 1.2;">
                                                You have been registered as a system user for the Smart Parking System Account. <hr>

                                                Your account name is : {{ $user->username}} .<br>

                                                To gain access to your account, please click on the link below to set your password:
                                              </p>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="pad" align="center">
                                            <div style="text-decoration: none; display: inline-block; color: #ffffff; background-color: #d0ae5e; border-radius: 4px; width: auto; border: 0; padding: 5px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: center;">
                                              <a href="{{ route('password.reset', ['token'=>$token])}}" style="color: #ffffff; text-decoration: none;">
                                                <i class="fa fa-sign-in-alt"></i> Create Account Password
                                              </a>
                                            </div>
                                          </td>
                                        </tr>
                                      </table>

                                    <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block block-4"
                                        role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                        width="100%">
                                        <tr>
                                            <td class="pad">
                                                <div
                                                    style="color:#101112;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>


                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
