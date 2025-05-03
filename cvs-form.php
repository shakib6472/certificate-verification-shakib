<div class="pre-loader">
    <div class="lds-hourglass"></div>
</div>

<div class="cvs">

    <div class="search-section" id="searchContainer">
        <h2>Verify Your Certificate</h2>
        <p>Enter Your Certificate ID (Without #)</p>
        <div class="search">
            <input type="text" id="insertedcertID" placeholder="e.g 3d13dea45cf49b3b" />
            <button id="certsearchbutton">Search</button>
        </div>
    </div>
    <div class="popup-section" id="popupContainer">
        <h2>Result</h2>
        <div class="success">
            <div class="success-message" id="successMessage">Certificate ID is valid!</div>
            <p>Certificate ID: <span id="certificateID"></span></p>
            <p>Student Name: <span id="certificateName"></span></p>
            <p>Issue Date: <span id="certificateDate"></span></p>
            <a href="http://localhost/safety/tutor-certificate?cert_hash=<span id='certificateID'></span>&regenerate=1" target="_blank" class="view-certificate">View Certificate</a>

        </div>
        <div class="error">
            <div class="error" id="errorMessage">Certificate ID is invalid!</div>
            <p>No Information Found with this Certificate ID</p>
        </div>
    </div>
</div>