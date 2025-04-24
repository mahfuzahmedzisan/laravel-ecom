import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-dt';
import 'datatables.net-buttons-dt';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-responsive-dt';
import 'datatables.net-scroller-dt';

DataTable.Buttons.jszip(jszip);
DataTable.Buttons.pdfMake(pdfmake);