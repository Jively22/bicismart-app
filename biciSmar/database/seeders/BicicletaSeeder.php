<?php

namespace Database\Seeders;

use App\Models\Bicicleta;
use Illuminate\Database\Seeder;

class BicicletaSeeder extends Seeder
{
    public function run(): void
    {
        Bicicleta::query()->delete();

        $bicicletas = [
            ['nombre' => 'EcoRide Ciudad 3.0', 'tipo' => 'mixta', 'descripcion' => 'Urbana ligera con cambios de 7 velocidades y frenos de disco.', 'precio_venta' => 1200, 'precio_alquiler_hora' => 8.5, 'stock' => 10, 'estado' => 'disponible', 'foto' => 'bicicletas/ecoride-ciudad.jpg'],
            ['nombre' => 'TrailX Montana Pro', 'tipo' => 'mixta', 'descripcion' => 'Montaña con suspensión delantera y llantas todo terreno.', 'precio_venta' => 1850, 'precio_alquiler_hora' => 12, 'stock' => 6, 'estado' => 'disponible', 'foto' => 'bicicletas/trailx-pro.jpg'],
            ['nombre' => 'Urban E-Move Electrica', 'tipo' => 'mixta', 'descripcion' => 'Eléctrica urbana con asistencia al pedaleo.', 'precio_venta' => 3200, 'precio_alquiler_hora' => 18, 'stock' => 4, 'estado' => 'disponible', 'foto' => 'bicicletas/urban-e-move.jpg'],
            ['nombre' => 'Sprint Road Aero', 'tipo' => 'venta', 'descripcion' => 'Ruta aero de carbono con grupo 105 y ruedas de perfil medio.', 'precio_venta' => 4200, 'precio_alquiler_hora' => 25, 'stock' => 3, 'estado' => 'disponible', 'foto' => 'bicicletas/sprint-road-aero.jpg'],
            ['nombre' => 'Gravel Explorer', 'tipo' => 'mixta', 'descripcion' => 'Aluminio con frenos de disco y llantas 700x40 para gravel.', 'precio_venta' => 2800, 'precio_alquiler_hora' => 16, 'stock' => 5, 'estado' => 'disponible', 'foto' => 'bicicletas/gravel-explorer.jpg'],
            ['nombre' => 'City Compact Plegable', 'tipo' => 'mixta', 'descripcion' => 'Plegable urbana con cambios internos.', 'precio_venta' => 1500, 'precio_alquiler_hora' => 10, 'stock' => 8, 'estado' => 'disponible', 'foto' => 'bicicletas/city-compact.jpg'],
            ['nombre' => 'E-Cargo Family', 'tipo' => 'mixta', 'descripcion' => 'Cargo eléctrica con canasto frontal reforzado.', 'precio_venta' => 5200, 'precio_alquiler_hora' => 28, 'stock' => 2, 'estado' => 'disponible', 'foto' => 'bicicletas/e-cargo-family.jpg'],
            ['nombre' => 'MTB Trail Alu 29', 'tipo' => 'mixta', 'descripcion' => 'Montaña aluminio con horquilla de 120mm.', 'precio_venta' => 2100, 'precio_alquiler_hora' => 14, 'stock' => 7, 'estado' => 'disponible', 'foto' => 'bicicletas/mtb-trail-29.jpg'],
            ['nombre' => 'Urban Fixie Steel', 'tipo' => 'mixta', 'descripcion' => 'Fixie de acero con freno delantero.', 'precio_venta' => 950, 'precio_alquiler_hora' => 7, 'stock' => 9, 'estado' => 'disponible', 'foto' => 'bicicletas/urban-fixie.jpg'],
            ['nombre' => 'Trekker Hybrid 2.0', 'tipo' => 'mixta', 'descripcion' => 'Híbrida con horquilla rígida y llantas 700x38.', 'precio_venta' => 1600, 'precio_alquiler_hora' => 11, 'stock' => 10, 'estado' => 'disponible', 'foto' => 'bicicletas/trekker-hybrid.jpg'],
            ['nombre' => 'City Comfort Step', 'tipo' => 'mixta', 'descripcion' => 'Cuadro step-through con parrilla y guardabarros.', 'precio_venta' => 1300, 'precio_alquiler_hora' => 9, 'stock' => 8, 'estado' => 'disponible', 'foto' => 'bicicletas/city-comfort-step.jpg'],
            ['nombre' => 'Mountain Hardtail 27.5', 'tipo' => 'mixta', 'descripcion' => 'Hardtail 27.5 con 100mm de recorrido.', 'precio_venta' => 1700, 'precio_alquiler_hora' => 12, 'stock' => 6, 'estado' => 'disponible', 'foto' => 'bicicletas/hardtail-27.jpg'],
            ['nombre' => 'Enduro Pro 160', 'tipo' => 'venta', 'descripcion' => 'Enduro de 160mm con frenos de 4 pistones.', 'precio_venta' => 4800, 'precio_alquiler_hora' => 30, 'stock' => 3, 'estado' => 'disponible', 'foto' => 'bicicletas/enduro-pro.jpg'],
            ['nombre' => 'Downhill Beast', 'tipo' => 'mixta', 'descripcion' => 'Bici de downhill doble suspensión 200mm.', 'precio_venta' => 5200, 'precio_alquiler_hora' => 35, 'stock' => 2, 'estado' => 'disponible', 'foto' => 'bicicletas/downhill-beast.jpg'],
            ['nombre' => 'Kids Fun 20', 'tipo' => 'mixta', 'descripcion' => 'Infantil rodado 20 con cambios de 6 velocidades.', 'precio_venta' => 600, 'precio_alquiler_hora' => 5, 'stock' => 12, 'estado' => 'disponible', 'foto' => 'bicicletas/kids-fun-20.jpg'],
            ['nombre' => 'Kids Trail 24', 'tipo' => 'mixta', 'descripcion' => 'Infantil rodado 24 con suspensión y disco.', 'precio_venta' => 800, 'precio_alquiler_hora' => 6, 'stock' => 10, 'estado' => 'disponible', 'foto' => 'bicicletas/kids-trail-24.jpg'],
            ['nombre' => 'Folding Lite 16', 'tipo' => 'mixta', 'descripcion' => 'Plegable compacta rodado 16 para ciudad.', 'precio_venta' => 900, 'precio_alquiler_hora' => 7, 'stock' => 9, 'estado' => 'disponible', 'foto' => 'bicicletas/folding-lite.jpg'],
            ['nombre' => 'Touring Classic', 'tipo' => 'mixta', 'descripcion' => 'Turismo con parrillas delantera y trasera.', 'precio_venta' => 2200, 'precio_alquiler_hora' => 13, 'stock' => 4, 'estado' => 'disponible', 'foto' => 'bicicletas/touring-classic.jpg'],
            ['nombre' => 'Steel Gravel Plus', 'tipo' => 'mixta', 'descripcion' => 'Gravel de acero con neumáticos 650b x 47.', 'precio_venta' => 2600, 'precio_alquiler_hora' => 15, 'stock' => 5, 'estado' => 'disponible', 'foto' => 'bicicletas/steel-gravel-plus.jpg'],
            ['nombre' => 'Carbon Race SL', 'tipo' => 'venta', 'descripcion' => 'Ruta ligera de carbono con SRAM Rival.', 'precio_venta' => 3900, 'precio_alquiler_hora' => 24, 'stock' => 4, 'estado' => 'disponible', 'foto' => 'bicicletas/carbon-race-sl.jpg'],
            ['nombre' => 'Carbon Race Di2', 'tipo' => 'venta', 'descripcion' => 'Ruta carbono con grupo electrónico 105 Di2.', 'precio_venta' => 5200, 'precio_alquiler_hora' => 32, 'stock' => 3, 'estado' => 'disponible', 'foto' => 'bicicletas/carbon-race-di2.jpg'],
            ['nombre' => 'Aero TT Time', 'tipo' => 'venta', 'descripcion' => 'Contrarreloj aero con ruedas de perfil alto.', 'precio_venta' => 5800, 'precio_alquiler_hora' => 35, 'stock' => 2, 'estado' => 'disponible', 'foto' => 'bicicletas/aero-tt-time.jpg'],
            ['nombre' => 'eMTB Trail Boost', 'tipo' => 'mixta', 'descripcion' => 'eMTB de trail con 150mm y batería integrada.', 'precio_venta' => 6200, 'precio_alquiler_hora' => 30, 'stock' => 3, 'estado' => 'disponible', 'foto' => 'bicicletas/emtb-trail-boost.jpg'],
            ['nombre' => 'eMTB Enduro Max', 'tipo' => 'mixta', 'descripcion' => 'eMTB enduro 170mm para descensos exigentes.', 'precio_venta' => 6800, 'precio_alquiler_hora' => 34, 'stock' => 2, 'estado' => 'disponible', 'foto' => 'bicicletas/emtb-enduro-max.jpg'],
            ['nombre' => 'Cargo Longtail Pro', 'tipo' => 'mixta', 'descripcion' => 'Cargo longtail con parrilla extendida.', 'precio_venta' => 3500, 'precio_alquiler_hora' => 20, 'stock' => 4, 'estado' => 'disponible', 'foto' => 'bicicletas/cargo-longtail.jpg'],
            ['nombre' => 'Cargo MidDrive', 'tipo' => 'mixta', 'descripcion' => 'Cargo eléctrica con motor central.', 'precio_venta' => 4800, 'precio_alquiler_hora' => 26, 'stock' => 3, 'estado' => 'disponible', 'foto' => 'bicicletas/cargo-midrive.jpg'],
            ['nombre' => 'Road Endurance Disc', 'tipo' => 'venta', 'descripcion' => 'Ruta endurance con geometría cómoda y disco.', 'precio_venta' => 3000, 'precio_alquiler_hora' => 18, 'stock' => 5, 'estado' => 'disponible', 'foto' => 'bicicletas/road-endurance.jpg'],
            ['nombre' => 'Road Climber Ultegra', 'tipo' => 'venta', 'descripcion' => 'Ruta escaladora con transmisión Ultegra.', 'precio_venta' => 3600, 'precio_alquiler_hora' => 22, 'stock' => 4, 'estado' => 'disponible', 'foto' => 'bicicletas/road-climber.jpg'],
            ['nombre' => 'Gravel Adventure Steel', 'tipo' => 'mixta', 'descripcion' => 'Gravel de acero para bikepacking.', 'precio_venta' => 2400, 'precio_alquiler_hora' => 14, 'stock' => 5, 'estado' => 'disponible', 'foto' => 'bicicletas/gravel-adventure.jpg'],
            ['nombre' => 'Gravel Race Carbon', 'tipo' => 'mixta', 'descripcion' => 'Gravel carbono con cockpit integrado.', 'precio_venta' => 4100, 'precio_alquiler_hora' => 23, 'stock' => 3, 'estado' => 'disponible', 'foto' => 'bicicletas/gravel-race-carbon.jpg'],
            ['nombre' => 'Urban Comfort Belt', 'tipo' => 'mixta', 'descripcion' => 'Urbana con correa y cambios internos.', 'precio_venta' => 2300, 'precio_alquiler_hora' => 13, 'stock' => 6, 'estado' => 'disponible', 'foto' => 'bicicletas/urban-belt.jpg'],
            ['nombre' => 'Urban SingleSpeed', 'tipo' => 'mixta', 'descripcion' => 'Cuadro urbano single speed minimalista.', 'precio_venta' => 800, 'precio_alquiler_hora' => 6, 'stock' => 9, 'estado' => 'disponible', 'foto' => 'bicicletas/urban-singlespeed.jpg'],
            ['nombre' => 'Fitness Flatbar', 'tipo' => 'mixta', 'descripcion' => 'Ruta fitness con manubrio plano y disco.', 'precio_venta' => 1700, 'precio_alquiler_hora' => 11, 'stock' => 7, 'estado' => 'disponible', 'foto' => 'bicicletas/fitness-flatbar.jpg'],
            ['nombre' => 'City Step Electric', 'tipo' => 'mixta', 'descripcion' => 'E-bike step-through para desplazamientos diarios.', 'precio_venta' => 3400, 'precio_alquiler_hora' => 20, 'stock' => 4, 'estado' => 'disponible', 'foto' => 'bicicletas/city-step-electric.jpg'],
            ['nombre' => 'Beach Cruiser', 'tipo' => 'mixta', 'descripcion' => 'Cruiser cómodo con llantas anchas.', 'precio_venta' => 1100, 'precio_alquiler_hora' => 8, 'stock' => 8, 'estado' => 'disponible', 'foto' => 'bicicletas/beach-cruiser.jpg'],
            ['nombre' => 'Fat Bike Snow', 'tipo' => 'mixta', 'descripcion' => 'Fat bike para arena o nieve con llantas 4.8.', 'precio_venta' => 2300, 'precio_alquiler_hora' => 16, 'stock' => 4, 'estado' => 'disponible', 'foto' => 'bicicletas/fat-bike-snow.jpg'],
            ['nombre' => 'BMX Park Pro', 'tipo' => 'mixta', 'descripcion' => 'BMX para park con cuadro reforzado.', 'precio_venta' => 900, 'precio_alquiler_hora' => 7, 'stock' => 6, 'estado' => 'disponible', 'foto' => 'bicicletas/bmx-park-pro.jpg'],
            ['nombre' => 'Dirt Jump 26', 'tipo' => 'mixta', 'descripcion' => 'Dirt jump con cuadro de acero y horquilla robusta.', 'precio_venta' => 1400, 'precio_alquiler_hora' => 10, 'stock' => 5, 'estado' => 'disponible', 'foto' => 'bicicletas/dirt-jump.jpg'],
            ['nombre' => 'Fixie Drop', 'tipo' => 'mixta', 'descripcion' => 'Fixie con manubrio drop para velocidad urbana.', 'precio_venta' => 850, 'precio_alquiler_hora' => 6, 'stock' => 7, 'estado' => 'disponible', 'foto' => 'bicicletas/fixie-drop.jpg'],
            ['nombre' => 'Folding Electric City', 'tipo' => 'mixta', 'descripcion' => 'Plegable eléctrica compacta.', 'precio_venta' => 2500, 'precio_alquiler_hora' => 17, 'stock' => 5, 'estado' => 'disponible', 'foto' => 'bicicletas/folding-electric-city.jpg'],
        ];

        foreach ($bicicletas as $bici) {
            Bicicleta::create($bici);
        }
    }
}
