@section('payment')
    <div class="pdf-inner-bank-title-payment">
        <h2 class="pdf-inner-h2-bank-title">
            PAYMENT DETAILS
        </h2>
    </div>

    <div class="pdf-inner-bank-title">
        <h3 class="pdf-inner-h3-bank-title">
            1. <span>ELECTRONIC FUNDS TRANSFER (EFT/RTGS)</span>
        </h3>
    </div>

    <table class="pdf-invoice-to-bank">
        <tbody>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">BANK NAME:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">NCBA Bank Kenya PLC</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">BRANCH:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">Kenyata Avenue</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">ADDRESS:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">P.O. Box 54140 - 00100 Nairobi</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">SWIFT CODE:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">CBAFKENX</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">ACCOUNT NAME:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">ENTER-BUSINESS-NAME</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">USD ACCOUNT NO:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">1234567890</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">KES ACCOUNT NO:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">1234567890</span>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="pdf-inner-bank-title">
        <h3 class="pdf-inner-tr-bank-title">
            2. <span>CHEQUE DEPOSIT</span>
        </h3>
    </div>

    <table class="pdf-invoice-to-bank pdf-invoice-to-bank-last">
        <tbody>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">PAYEE:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">ENTER-BUSINESS-NAME</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">USD ACCOUNT NO:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">1234567890</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">KES ACCOUNT NO:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">1234567890</span>
                </td>
            </tr>
            <tr>
                <td class="pdf-inner-td-bank pdf-left">
                    <span class="pdf-span-bank">BANK NAME:</span>
                </td>
                <td class="pdf-inner-td-bank">
                    <span class="pdf-span-account">NCBA Bank Kenya PLC</span>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="pdf-inner-bank-title">
        <h3 class="pdf-inner-tr-bank-title">
            3. <span>ONLINE PAYMENT</span>
        </h3>
    </div>

    <table class="pdf-invoice-to-bank pdf-invoice-to-bank-last">
        <tbody>
            <tr>
                <td class="pdf-inner-td-bank pdf-left" style="width: 100% !important">
                    <span class="pdf-span-account"><a style="color: #237F43" href="#" target="_blank">click here</a>
                        or
                        copy and paste this link to your browser
                        <span style="text-decoration: underline; color: #237F43; font-size:13px">
                            pay-via-car-or-mpesa
                        </span>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
