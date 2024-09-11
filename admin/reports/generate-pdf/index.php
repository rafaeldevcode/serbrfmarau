<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use Src\Models\Location;
use Src\Models\Reservation;

$reservation = new Reservation();
$location = new Location();

$reservations = filterReservationsReports($reservation);
$locations = $location->get();

$reservationsByLocation = reservationsByLocations($locations);

// Configurações da Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // Permite carregar arquivos externos, como CSS

$dompdf = new Dompdf($options);

// O HTML que você deseja converter em PDF com estilos aplicados diretamente
$html = '
<div style="font-family: Arial, sans-serif; color: #333; max-width: 1000px; margin: 0 auto; padding: 20px;">
    <!-- Tabela de Reservas por Local -->
    <div style="margin-bottom: 30px; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
            <thead>
                <tr style="background-color: #1E3E87; color: white;">
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Local</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Responsável</th>
                    <th style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">Total de Reservas</th>
                </tr>
            </thead>
            <tbody>';

// Preenche o HTML com os dados
foreach ($reservationsByLocation as $reservation) {
    $html .= '<tr style="background-color: #fff; border-bottom: 1px solid #ddd;">
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">' . $reservation['location'] . '</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">' . $reservation['responsible'] . '</td>
                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">' . $reservation['total_reservation'] . '</td>
              </tr>';
}

$html .= '</tbody></table></div>';

$html .= '
    <!-- Tabela de Detalhes de Reservas -->
    <div style="margin-bottom: 30px; border: 1px solid #ddd; border-radius: 8px; padding: 20px;">
        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
            <thead>
                <tr style="background-color: #1E3E87; color: white; text-align: left;">
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Data</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Horários</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Nome</th>
                    <th style="padding: 10px; border-bottom: 1px solid #ddd; text-align: left;">Local</th>
                    <th style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">Valor</th>
                </tr>
            </thead>
            <tbody>';

foreach ($reservations->data as $reservation) {
    $html .= '<tr style="background-color: #fff; border-bottom: 1px solid #ddd;">
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">' . ($reservation->type == 'Fixo' ? $reservation->day : date('d/m/Y', strtotime($reservation->date))) . '</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">' . $reservation->period . '</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">' . $reservation->name . '</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Local Exemplo</td>
                <td style="padding: 10px; text-align: right; border-bottom: 1px solid #ddd;">R$100,00</td>
              </tr>';
}

$html .= '</tbody></table></div></div>';

// Define o HTML no Dompdf
$dompdf->loadHtml($html);

// (Opcional) Definir o tamanho do papel e a orientação
$dompdf->setPaper('A4', 'portrait');

// Renderiza o PDF
$dompdf->render();

// Envia o PDF gerado para o navegador
$dompdf->stream('reservations.pdf', ['Attachment' => false]);

?>
