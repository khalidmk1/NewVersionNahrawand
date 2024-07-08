<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\QuizIntreface;
use App\Http\Requests\QuizRequest;
use App\Interfaces\VideoInterface;
use App\Interfaces\TicketInterface;
use App\Interfaces\ContentInterface;
use App\Interfaces\ProfileInterface;
use App\Http\Requests\DestroyRequest;
use App\Interfaces\NotificationInterface;

class GlobaleController extends Controller
{
    private $ContentInterface;
    private $ProfileInterface;
    private $videoInterface;
    private $TicketInterface;
    private $QuizInterface;
    private $notificationInterface;

    public function __construct(
        ContentInterface $ContentInterface,
        ProfileInterface $ProfileInterface,
        VideoInterface $videoInterface,
        TicketInterface $TicketInterface,
        QuizIntreface $QuizInterface,
        NotificationInterface $notificationInterface
    ) {
        $this->ContentInterface = $ContentInterface;
        $this->ProfileInterface = $ProfileInterface;
        $this->videoInterface = $videoInterface;
        $this->TicketInterface = $TicketInterface;
        $this->QuizInterface = $QuizInterface;
        $this->notificationInterface = $notificationInterface;
    }

    // Content-related actions
    public function objectivesByCategory(String $id)
    {
        return $this->ContentInterface->objectivesByCategory($id);
    }

    public function quicklyIndex()
    {
        return $this->ContentInterface->quicklyIndex();
    }

    public function history()
    {
        return $this->ContentInterface->history();
    }

    // Profile-related actions
    public function indexAdmin()
    {
        return $this->ProfileInterface->indexAdmin();
    }

    public function passwordChange()
    {
        return $this->ProfileInterface->passwordChange();
    }

    public function indexManager()
    {
        return $this->ProfileInterface->indexManager();
    }

    public function indexSpeaker()
    {
        return $this->ProfileInterface->indexSpeaker();
    }

    public function indexClient()
    {
        return $this->ProfileInterface->indexClient();
    }

    public function createAdmin()
    {
        return $this->ProfileInterface->createAdmin();
    }

    public function createManager()
    {
        return $this->ProfileInterface->createManager();
    }

    public function createSpeaker()
    {
        return $this->ProfileInterface->createSpeaker();
    }

    //notification

    public function allSentNotification(){
        return $this->notificationInterface->allSentNotification();
    }

    public function allUserNotfication(){
        return $this->notificationInterface->allUserNotfication();
    }

  /*  

    public function allNotification()
    {
        return $this->notificationInterface->allNotification();
    } */

    /* public function notificationRead(String $notificationId){
        return $this->ProfileInterface->notificationRead($notificationId);
    }

    public function notificationDelete(String $notificationId){
        return $this->ProfileInterface->notificationDelete($notificationId);
    } */

    // Ticket-related actions
    public function createComment(Request $request, String $id)
    {
        return $this->TicketInterface->createComment($request, $id);
    }

    // Video-related actions
    public function deletevideo(DestroyRequest $request, String $id)
    {
        return $this->videoInterface->delete($request, $id);
    }

    // Quiz-related actions
    public function storeContentQsm(QuizRequest $request, String $id)
    {
        return $this->QuizInterface->storeContentQsm($request, $id);
    }

    public function storeNote(Request $request , String $id){
        return $this->QuizInterface->storeNote($request, $id);
    }
}
