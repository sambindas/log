<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta property="og:title" content="eClat">
        <meta property="og:description" content="">
        <meta property="og:image" content="https://res.cloudinary.com/dpiyqfdpk/image/upload/v1627104618/logo2_k3ibfh.svg">
        <meta property="og:url" content="https://eclinic2.netlify.app">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../assets/images/logo.svg" type="image/x-icon" />
        <link rel="stylesheet" href="../assets/css/incident.css">
        <title>eClat | Incident</title>
    </head>
<body>
    <div class="pd-incident">
        <div class="modal">
            <div class="modal-content">
                <form action="">
                    <p class="log">Log Incident</p>

                    <div class="groupFlex">
                        <div class="group">
                            <label for="">Select incident category</label>
                            <select name="" id="">
                                <option value="">Select Category</option>
                            </select>
                            <img src="../assets/images/selectdown.svg" alt="icon">
                        </div>

                        <div class="group">
                            <label for="">Select facility</label>
                            <select name="" id="">
                                <option value="">Select facility</option>
                            </select>
                            <img src="../assets/images/selectdown.svg" alt="icon">
                        </div>
                    </div>

                    <div class="groupFlex">
                        <div class="group">
                            <label for="">Select module</label>
                            <select name="" id="">
                                <option value="">Select module</option>
                            </select>
                            <img src="../assets/images/selectdown.svg" alt="icon">
                        </div>

                        <div class="group">
                            <label for="">Select item</label>
                            <select name="" id="">
                                <option value="">Select item</option>
                            </select>
                            <img src="../assets/images/selectdown.svg" alt="icon">
                        </div>
                    </div>

                    <div class="area">
                        <label for="">Incident description</label>
                        <textarea name="" id=""  rows="5" placeholder="Write a description of the incident encountered here.." ></textarea>
                    </div>

                    <div class="groupFlex">
                        <div class="group">
                            <label for="">Reporting client</label>
                            <input type="text" placeholder="Enter client name"/>
                        </div>

                        <div class="group">
                            <label for="">Affected departments</label>
                            <input type="text" placeholder="Enter department name"/>
                        </div>
                    </div>

                    <div class="groupFlex">
                        <div class="group">
                            <label for="">Incident report date</label>
                            <input type="date" name="" id="">
                        </div>

                        <div class="group">
                            <label for="">Assign incident (optional)</label>
                            <select name="" id="">
                                <option value="">Select users</option>
                            </select>
                            <img src="../assets/images/selectdown.svg" alt="icon">
                        </div>
                    </div>

                    <div class="toggle">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                        <p>Update client via email</p>
                    </div>

                    <div class="submitDiv">
                        <button type="submit">Log Incident</button>
                    </div>

                </form>
         
            </div>
        </div>

    </div>
    <script src="../assets/scripts/incident.js"></script>
    <script src="../assets/scripts/pagination.js"></script>
    <script src="../assets/scripts/header.js"></script>
    <script src="../assets/scripts/modal.js"></script>
    <script src="../assets/scripts/detail.js"></script>
   
   
</body>
</html>