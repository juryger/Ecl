/**
 * Animation options for contest banner.
 * @type {{duration: number, easing: string}}
 */
var animationOptions = {
    duration: 1500,
    easing: 'linear'
};

var animationOptions2 = {
    duration: 800,
};

/**
 * Start contest animation.
 */
function fireContestAnimation() {

    $("img#cbBackground")
        .animate({
                opacity: 1
            },
            $.extend(true, {}, animationOptions, {
                complete: function() {
                    fireContestQuestionOne();
                }
            })
        );
}

function fireContestQuestionOne() {
    var questionLabel = $("img#cbQuestionOneLabel");

    // set initial position
    questionLabel.css("top", "90");
    questionLabel.css("left", "45");

    // start animation
    questionLabel
        .animate({
                opacity: 1
            },
            animationOptions)
        .animate({
                top: 25
            },
            $.extend(true, {}, animationOptions2, {
                complete: function() {
                    fireContestQuestionTwo();
                }
            })
        );
}

function fireContestQuestionTwo() {
    var questionLabel = $("img#cbQuestionTwoLabel");

    // set initial position
    questionLabel.css("top", "90");
    questionLabel.css("left", "85");

    // start animation
    questionLabel
        .animate({
                opacity: 1
            },
            animationOptions)
        .animate({
                top: 170
            },
            $.extend(true, {}, animationOptions2, {
                complete: function() {
                    fireFaces();
                }
            })
        );
}

function fireFaces() {
    var face1 = $("img#cbFace1");
    var face2 = $("img#cbFace2");
    var face3 = $("img#cbFace3");
    var face4 = $("img#cbFace4");

    // set initial position
    face1.css("top", "60");
    face1.css("left", "195");

    face2.css("top", "60");
    face2.css("left", "195");

    face3.css("top", "60");
    face3.css("left", "195");

    face4.css("top", "60");
    face4.css("left", "195");

    // start animation
    face1
        .animate({
                opacity: 1,
                left: 60,
            },
            animationOptions);

    face2
        .animate({
                opacity: 1,
                left: 145,
            },
            animationOptions);

    face3
        .animate({
                opacity: 1,
                left: 250,
            },
            animationOptions);

    face4
        .animate({
                opacity: 1,
                left: 350,
            },
            $.extend(true, {}, animationOptions, {
                complete: function() {
                    fireBlinds();
                }
            })
        );
}

function fireBlinds() {
    var blindsLeft = $("img#cbBlindsLeft");
    var blindsRight = $("img#cbBlindsRight");
    var invitationLabel = $("img#cbInvitationLabel");

    // set initial position
    blindsLeft.css("top", "0");
    blindsLeft.css("left", "0");

    blindsRight.css("top", "0");
    blindsRight.css("left", "243");

    invitationLabel.css("top", "100");
    invitationLabel.css("left", "65");

    // start animation
    blindsLeft
        .delay(1500)
        .show(
            "slide",
            {
                direction: "right"
            },
            1000);

    blindsRight
        .delay(1500)
        .show(
            "slide",
            {
                direction: "left"
            },
            1000);

    // start animation
    invitationLabel
        .delay(1500)
        .animate({
                opacity: 1
            },
            $.extend(true, {}, animationOptions, {
                complete: function() {
                    fireContestInfo();
                }
            })
        );
}

function fireContestInfo() {
    var contestNameLabel = $("img#cbContestNameLabel");
    var contestApply = $("div#cbContestApply");

    // set initial position
    contestNameLabel.css("top", "5");
    contestNameLabel.css("left", "540");

    contestApply.css("top", "180");
    contestApply.css("left", "530");

    // start animation
    contestApply
        .delay(1500)
        .animate({
                opacity: 1
            },
            animationOptions);

    contestNameLabel
        .delay(500)
        .animate({
                opacity: 1
            },
            animationOptions
        );
}