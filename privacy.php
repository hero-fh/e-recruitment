<?php require_once('./config.php') ?>

<style>
    .modal-header {
        display: none;
    }
</style>
<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<form id="frm" style="text-align:justify;">
    <div class="row">
        <p class="MsoNormal" align="left" style="margin: 0cm; text-indent: 0cm; line-height: 107%; background: rgb(153, 51, 0);"><b><span style="font-size:24.0pt;line-height:107%;color:white">T
                    E L F O R D</span></b>
            <o:p></o:p>
        </p>
    </div>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 1.45pt; text-indent: 0cm; line-height: 107%;"><b><span style="font-size:11.5pt;line-height:107%">TELFORD
                SVC. PHILS., INC.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
        </b>
        <o:p></o:p>
    </p>
    <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;
margin-bottom:.8pt;margin-left:46.0pt;text-align:center;text-indent:0cm;
line-height:107%"><b>&nbsp;</b>
        <o:p></o:p>
    </p>
    <h5 style="margin-left:43.25pt"><b> PRIVACY NOTICE AND CONSENT FORM (JOB APPLICANT) </b>
        <o:p></o:p>
    </h5>
    <p class="MsoNormal" align="center" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;
margin-bottom:0cm;margin-left:46.0pt;text-align:center;text-indent:0cm;
line-height:107%"><b>&nbsp;</b>
        <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify; margin-left:43.25pt;">To ensure that your rights as a
        Data Subject under Republic Act No. 10173 otherwise known as the Data Privacy
        Act of 2012 are secured, Telford Svc. Phils., Inc. has implemented reasonable
        and appropriate organizational, physical and technical measures intended to
        protect your personal information and/or sensitive personal information against
        any unauthorized, accidental and/or unlawful processing under the following
        terms and conditions: <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <h5 style="margin-left:43.25pt"><b> PERSONAL INFORMATION AND SENSITIVE
            INFORMATION TO BE PROCESSED </b>
        <o:p></o:p>
    </h5>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;  float: left;">&nbsp;<o:p></o:p>
    </p>

    <p class="MsoNormal" align="left" style="margin-right:43.25pt;text-align: justify; margin-left:43.25pt;">
        The type of personal information or sensitive personal information which the Company may collect either directly or indirectly in relation to your job application for the position of

        <select name="application" class="select2" id="app" required>
            <option value="" disabled <?= !isset($application) ? "selected" : "" ?>></option>
            <?php
            $application = $conn->query("SELECT * FROM `position` where  `status` = 1 ORDER BY position");
            while ($row = $application->fetch_assoc()) :
            ?>
                <option value="<?= $row['application_id'] ?>" <?php echo isset($position) && $position == $row['id'] ? 'selected' : '' ?>><?= $row['position'] ?></option>
            <?php endwhile; ?>
        </select>
        shall include, among others, the following personal and sensitive personal information:
    </p>

    <o:p></o:p>
    <p></p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:94.9pt;margin-bottom:
.2pt;margin-left:107.2pt;text-indent:-18.0pt;"><span>1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Full
        Name <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:94.9pt;margin-bottom:
.2pt;margin-left:107.2pt;text-indent:-18.0pt;"><span>2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Present,
        Permanent or Provincial Address <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:94.9pt;margin-bottom:
.2pt;margin-left:107.2pt;text-indent:-18.0pt;"><span>3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->
        Land line and Mobile No. <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Email
        Address <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>5.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Date
        of Birth /Place of Birth <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>6.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Civil
        Status <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>7.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Gender
        <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>8.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Religion
        <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>9.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->TIN
        / SSS/Philhealth/HDMF No. <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>10.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->School
        Credentials &amp; details and Educational Attainment <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>11.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->Driver’s
        License No. <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>12.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->Barangay/Police/NBI
        Clearance <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>13.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->Health
        Records <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>14.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->Past
        Record of Employment <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>15.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->Character
        References <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>16.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->Spouse
        Name <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>17.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->Children’s
        Name <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:107.2pt;text-indent:-18.0pt;"><span>18.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp; </span></span><!--[endif]-->Valid
        IDs <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 107.95pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <h5 style="margin-left:43.25pt"><b>II. PURPOSE OF THE PROCESSING OF INFORMATION </b>
        <o:p></o:p>
    </h5>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify;margin-left:43.25pt;">Any and all processing of personal
        information related to your job application shall be made for a legal purpose
        and/or pursuant to a legal obligation under applicable laws taking into
        consideration appropriate security measures to ensure the confidentiality
        and/or integrity of the personal information involved. This includes, among
        others, the evaluation and approval of your job application. <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <h5 style="margin-left:43.25pt"><b>III. PROCESSING OF INFORMATION</b>
        <o:p></o:p>
    </h5>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0.3pt 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify;margin-left:43.25pt;">Any and all personal information
        related to you which may come into the Company’s possession and/or control
        during the processing of your job application shall be used for the following
        purposes: <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:79.5pt;text-indent:-18.0pt;"><span>1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Processing
        your job application which shall be based on the information you provide the
        Company. This shall be used to determine your qualification and/or eligibility
        for the position which you are applying for hence you should ensure the
        accuracy and authenticity of all your given personal information; <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 79.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:79.5pt;text-indent:-18.0pt;"><span>2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Background
        investigation to determine your qualification as (position). The Company may
        conduct background investigation from your past/present employment to verify
        the authenticity of the information provided in your Resume and during
        interview such as:&nbsp; <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0.7pt 79.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:92.85pt;text-indent:-13.95pt;"><span>a.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp; </span></span><!--[endif]-->Applicant’s
        Name <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:92.85pt;text-indent:-13.95pt;"><span>b.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp; </span></span><!--[endif]-->Position&nbsp; <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:92.85pt;text-indent:-13.95pt;"><span>c.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp; </span></span><!--[endif]-->Compensation
        package <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:92.85pt;text-indent:-13.95pt;"><span>d.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp; </span></span><!--[endif]-->Record
        of Attendance <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:92.85pt;text-indent:-13.95pt;"><span>e.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp; </span></span><!--[endif]-->Record
        of Performance <o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:92.85pt;text-indent:-13.95pt;"><span>f.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Reason
        for leaving the Company <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 79.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 79.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify;margin-left:43.25pt;">The types of information to be
        verified with your past/present employment involve personal information and/or
        sensitive personal information. Please be informed that as a data subject, you
        have the right to access and correct the information, in case of inaccurate or
        incomplete data. <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-top:0cm;margin-right:43.25pt;text-align: justify;margin-bottom:.2pt;
margin-left:79.5pt;text-indent:-18.0pt;"><span>3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-stretch: normal; font-size: 7pt; line-height: normal; ">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]-->Enrollment
        to government agencies like SSS, HDMF, Philhealth and BIR, this includes the
        opening of a payroll account with the company’s chosen bank should you qualify
        to the job applied. <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 79.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify;margin-left:43.25pt;">For other legitimate and/or
        business-related purpose. The Company reserves the right to process your
        personal information such as but not limited to (1) to comply with applicable
        laws and legal obligations; (2) to respond to governmental inquiries or
        requests from public authorities; (3) to comply with valid legal processes
        issued by competent government authorities; (4) to protect the rights, privacy,
        safety or property of the Company, site visitors, guests, employees or the
        general public; (5) to permit the Company to pursue available remedies or limit
        the damages that the Company may sustain; (6) to respond to an emergency;
        and/or (7) to monitor and comply with applicable laws, regulations, policies
        and procedures. <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify;margin-left:43.25pt;">The accuracy of the personal
        information is of vital importance to the Company for the above stated
        purposes. Therefore, your immediate advice to the Company to correct the
        provided personal and sensitive information (if there’s any) is of utmost
        importance.&nbsp; <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <h5 style="margin-left:43.25pt"><b>&nbsp;IV.
            RETENTION OF INFORMATION</b>
        <o:p></o:p>
    </h5>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify;margin-left:43.25pt;">The Company shall only retain your
        information only for 3 years starting day one (1) of your separation from the
        company and/or until the declared, specific and legitimate purpose has been
        achieved or the processing relevant to the purpose has been terminated.
        However, the Company reserves its rights to retain your information when
        necessary to establish, exercise or defend legal claims, for legitimate
        business purposes, or when provided by law, which must be in accordance with
        standards followed by the applicable industry or approved by appropriate
        government agency. <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <h5 style="margin-left:43.25pt"><b>V. CONTACT DETAILS </b>
        <o:p></o:p>
    </h5>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify;margin-left:43.25pt;">Should you have concerns, questions
        or matters for clarification with regards to the processing of personal
        information, you may contact the number (046) 4330536 local 1002. You may
        report your concerns and complaints by email at <u><span style="color:#0563C1">charitylanceta@astigp.com</span></u>. <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" style="margin-right:43.25pt;text-align: justify;margin-left:43.25pt;">Submitting your information
        signifies that you have read and understood the above policy and expressly
        consent to the processing of your personal and/or sensitive personal
        information in the manner and for the purpose provided in this notice. You
        understand and accept that this will include access to personal data and
        records submitted, which may be regarded as personal and/or sensitive personal
        data as provided under the Data Protection Act of 2012. <o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<o:p></o:p>
    </p>
    </p>
    <p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); ">




    </p>
    <div style="display: flex; justify-content: space-between; margin-right:43.25pt;margin-left:43.25pt;">
        <h6 style="margin: 0;"><b>TELFORD SVC. PHILS., INC.</b></h6>
        <h6 style="margin: 0;"><b>ADMIN-30 (Rev.3)</b>
            <o:p></o:p>
        </h6>

    </div>



    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
    </p>
    <p class="MsoNormal" align="left" style="margin: 0cm 0cm 0cm 43.5pt; text-indent: 0cm; line-height: 107%;">&nbsp;<o:p></o:p>
        <button type="button" class="close" id="click" data-dismiss="modal" aria-label="Close">

        </button>
    <div class="row  justify-content-center  ">
        <div class="col-4 ">
            <button type="submit" class="btn btn-primary btn-block">Agree</button>
        </div>
    </div>
    <!-- <p id="savedValue"></p> -->
</form>

<script>
    $('.select2').select2({
        width: 'resolve'
    })
    var submitButton = document.getElementById('click');
    $('#frm').submit(function(e) {
        e.preventDefault()
        var _this = $(this)
        if ($('.err_msg').length > 0)
            $('.err_msg').remove()
        var el = $('<div class="alert err_msg">')
        el.hide()
        closeModal()

    });

    // Function to close the modal and send the input values to the parent page
    function closeModal() {
        // Get the input values from the modal
        var input1 = document.getElementById("app").value;
        var e = document.getElementById("app");
        var value = e.value;
        var text = e.options[e.selectedIndex].text;
        console.log(text)
        // Construct an object with the input values
        var inputValues = input1;
        var text = text;

        submitButton.click();
        // Trigger a custom event and pass the input values to the parent page
        window.parent.postMessage({
            type: "modalClosed",
            inputValues: inputValues,
            text: text
        }, "*");
    }
</script>