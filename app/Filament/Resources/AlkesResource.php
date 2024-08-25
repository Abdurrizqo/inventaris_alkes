<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlkesResource\Pages;
use App\Models\AlatKesehatan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AlkesResource extends Resource
{
    protected static ?string $model = AlatKesehatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'Alat Kesehatan';

    protected static ?string $pluralModelLabel = 'Alat Kesehatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ruangan')
                    ->relationship('ruanganJoin', 'nama_ruangan')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nama_alat_kesehatan')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('foto_alat_kesehatan')
                    ->directory('alat-kesehatan')
                    ->visibility('private')
                    ->image()
                    ->moveFiles()
                    ->openable()
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend($this->generateRandomString() . '-')
                    )
                    ->required()
                    ->maxSize(3024),
                FileUpload::make('foto_serial_number')
                    ->directory('serial-number')
                    ->visibility('private')
                    ->image()
                    ->openable()
                    ->moveFiles()
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend($this->generateRandomString() . '-')
                    )
                    ->maxSize(3024),
                TextInput::make('kode_inventaris')
                    ->required()
                    ->maxLength(255),
                TextInput::make('merk')
                    ->maxLength(255),
                TextInput::make('type')
                    ->maxLength(255),
                TextInput::make('nomer_seri')
                    ->required()
                    ->maxLength(255),
                TextInput::make('akd')
                    ->maxLength(255),
                TextInput::make('akl')
                    ->maxLength(255),
                Select::make('klasifikasi')
                    ->required()
                    ->options([
                        'Bedah dan Anestesi' => 'Bedah dan Anestesi',
                        'Diagnostik' => 'Diagnostik',
                        'Laboratorium' => 'Laboratorium',
                        'Life Support' => 'Life Support',
                        'Radiologi' => 'Radiologi',
                        'Terapi' => 'Terapi',
                    ]),
                Select::make('teknologi')
                    ->required()
                    ->options([
                        'Teknologi Sederhana' => 'Teknologi Sederhana',
                        'Teknologi Menengah' => 'Teknologi Menengah',
                        'Teknologi Tinggi' => 'Teknologi Tinggi',
                    ]),
                Select::make('risiko')
                    ->required()
                    ->options([
                        'Risiko Rendah' => 'Risiko Rendah',
                        'Risiko Menengah' => 'Risiko Menengah',
                        'Risiko Tinggi' => 'Risiko Tinggi',
                    ]),
                Select::make('sumber_pendanaan')
                    ->required()
                    ->options([
                        'APBD' => 'APBD',
                        'BLUD' => 'BLUD',
                        'DAk' => 'DAk',
                        'HIBAH' => 'HIBAH',
                    ]),
                DatePicker::make('tanggal_pengadaan')
                    ->required(),
                DatePicker::make('masa_garansi'),
                TextInput::make('nama_penyedia')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_alat_kesehatan'),
                TextColumn::make('kode_inventaris'),
                TextColumn::make('tanggal_pengadaan'),
                TextColumn::make('sumber_pendanaan'),
                TextColumn::make('akd'),
                TextColumn::make('akl'),
                TextColumn::make('masa_garansi'),
                TextColumn::make('nama_penyedia'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Action::make('create qr')
                        ->label('QR Code')
                        ->icon('heroicon-m-qr-code')
                        ->color(Color::hex('#006989'))
                        ->action(function ($record) {
                            $result = Builder::create()
                                ->writer(new PngWriter())
                                ->writerOptions([])
                                ->data(env('APP_URL').'/data-alkes/'.$record->id)
                                ->encoding(new Encoding('UTF-8'))
                                ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                                ->size(300)
                                ->margin(10)
                                ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                                // ->logoPath(__DIR__ . '/assets/symfony.png')
                                // ->logoResizeToWidth(50)
                                // ->logoPunchoutBackground(true)
                                ->labelText($record->kode_inventaris)
                                ->labelFont(new NotoSans(20))
                                ->labelAlignment(LabelAlignment::Center)
                                ->validateResult(false)
                                ->build();

                            $filePath = 'qr-codes/' . $record->id . '.png';

                            // Save the file to the storage path
                            Storage::put($filePath, $result->getString());

                            return Storage::download($filePath);
                        })
                ])
                    ->button()
                    ->label('Kelola')
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlkes::route('/'),
            'create' => Pages\CreateAlkes::route('/create'),
            'view' => Pages\ViewAlkes::route('/{record}'),
            'edit' => Pages\EditAlkes::route('/{record}/edit'),
        ];
    }

    private function generateRandomString(int $length = 6): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength
            = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
