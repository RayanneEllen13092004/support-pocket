<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Municipality::create([
           'name' => 'Maceió',
           'curriculum_matrix' => 'Matriz Curricular Padrão Capital - 2026. Consultar PDF na pasta do drive.',
           'anchor_instructions' => 'ALERTA: Sempre perguntar ao âncora responsável antes de abrir um novo ano letivo escolar.',
        ]);

        Municipality::create([
            'name' => 'Arapiraca',
            'curriculum_matrix' => 'Matriz Curricular Agreste - 2026. Específica para escolas rurais e integrais.',
            'anchor_instructions' => 'Atenção: O fechamento de notas ocorre em datas diferenciadas. Consultar calendário letivo local antes de prosseguir.',
        ]);
    }
}
