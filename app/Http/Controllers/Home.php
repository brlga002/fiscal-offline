<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professional;
use App\Debits;
use App\User;
use App\Helpers\ImportDataFromFileToDb;

class Home extends Controller
{
    public function index()
    {
        $professionals = Professional::all();

        return view('home',[
            'professionals' => $professionals
        ]);

    }

    public function show(Professional $professional)
    {
        $debits = Debits::where('codigo_interno_pessoa_fisica_juridica','=',$professional->codigo_interno)
            ->orderBy('contas_a_receber_ano', 'desc')
            ->orderBy('contas_a_receber_vencimento', 'desc')
            ->get();;

        return view('profissional-show',[
            'professional' => $professional,
            'debits' => $debits
        ]);
    }

    public function professionalFile()
    {
        return view('formUploadFile');
    }

    public function debitoFile()
    {
        return view('formUploadFileDebito');
    }

    public function professionalFileUpdate(Request $request)
    {
        $file = $request->file('file');

        if (empty($file)) {
            abort(400, 'Nenhum arquivo foi enviado.');
        }

        $path = $file->storeAs('uploads','professionals.xls');

        $teste = new ImportDataFromFileToDb();
        $teste->upload('professionals.xls','professionals');

        return redirect()->route('home.index');     
    }

    public function debitFileUpdate(Request $request)
    {
        $file = $request->file('file');

        if (empty($file)) {
            abort(400, 'Nenhum arquivo foi enviado.');
        }

        $path = $file->storeAs('uploads','debits.xls');

        $teste = new ImportDataFromFileToDb();
        $teste->upload('debits.xls','debits');

        return redirect()->route('home.index');     
    }
}
