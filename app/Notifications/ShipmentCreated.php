<?php
namespace App\Notifications;
    use Barryvdh\DomPDF\Facade as PDF;


    use App\Models\Shipment;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    class ShipmentCreated extends Notification implements ShouldQueue
    {
        use Queueable;

        /**
         * Create a new notification instance.
         *
         * @return void
         */
        public $shipment;
        public $items;
        public function __construct(Shipment $shipment, $items)
        {
            $this->shipment=$shipment;
            $this->items=$items;
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function via($notifiable)
        {
            return ['mail'];
        }

        /**
         * Get the mail representation of the notification.
         *
         * @param  mixed  $notifiable
         * @return \Illuminate\Notifications\Messages\MailMessage
         */
        public function toMail($notifiable)
        {

        $pdf =PDF::loadView('admin.shipment.pdf', ['shipment'=>$this->shipment,'items'=>$this->items])->setPaper('a4', 'potrait');
            return (new MailMessage)
                        ->greeting('Hi!'.$this->shipment->from_name)
                        ->line('Your Shipment has been created.')
                        ->line('A receipt has been attached to mail.')
                        ->action('Track Shipment', url('/tracking.html?awb_no='.$this->shipment->awb_no))
                        ->attachData($pdf->output(),'shipment.pdf',[
                            'mime' => 'application/pdf',
                        ]);
        }

        /**
         * Get the array representation of the notification.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function toArray($notifiable)
        {
            return [
                //
            ];
        }
    }
