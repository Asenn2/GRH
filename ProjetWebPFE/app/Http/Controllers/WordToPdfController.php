<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Contrat;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Metadata\Settings;
use PhpOffice\PhpWord\Settings as PhpWordSettings;

class WordToPdfController extends Controller
{
    //Récupère l'id du contrat pour en extraire ou est stocké le fichier word 
    public function convertWordToPdf($id)
    { {
            $contrat = Contrat::findOrFail($id);

            $domPdfPath = base_path('vendor/dompdf/dompdf');

            \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
            \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
            $Content = \PhpOffice\PhpWord\IOFactory::load($contrat->contratFile);
            $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');

            $pdfFileName = time() . '.pdf';
            $pdfpath = public_path('Contrats/PDFCONTRAT/' . $pdfFileName);
            $PDFWriter->save($pdfpath);
            $pdfPathUrl = url('Contrats/PDFCONTRAT/' . $pdfFileName);

            // Retourner le chemin du fichier PDF
            return response()->json(['pdfpathurl' => $pdfPathUrl]);
        }
    }

    //Affiche le pdf dans l'iframe
    public function afficherPdf($pdfFileName)
    {
        $pdfPath = public_path('Contrats/PDFCONTRAT/' . $pdfFileName);
        return response()->file($pdfPath);
    }
    public function afficherCv($id)
    {
        $Candidat = Candidat::findOrFail($id);
        $cv = $Candidat->Cv;

        $domPdfPath = base_path('vendor/dompdf/dompdf');

        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        $Content = \PhpOffice\PhpWord\IOFactory::load(storage_path('app/public/') . $Candidat->Cv);
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');

        $pdfFileName = time() . '.pdf';
        $pdfpath = public_path('Cv/' . $pdfFileName);
        $PDFWriter->save($pdfpath);
        $pdfPathUrl = url('Cv/' . $pdfFileName);


        // Retourner le chemin du fichier PDF
        return response()->json(['pdfpathurl' => $pdfPathUrl]);
    }
}
