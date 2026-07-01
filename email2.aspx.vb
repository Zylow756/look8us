
Imports System.Net.Mail
Imports System.Data.Odbc.OdbcConnection
Imports System.Data

Partial Class email2
    Inherits System.Web.UI.Page
    Private con As Odbc.OdbcConnection
    Private dr As Odbc.OdbcDataReader
    Private cmd As Odbc.OdbcCommand
    Private dadd As Odbc.OdbcDataAdapter
    Private ds As DataSet
    Private dt As DataTable


    Private dadd1 As Odbc.OdbcDataAdapter
    Private ds1 As DataSet
    Private dt1 As DataTable


    Private cur As Integer = 0
    Private tot As Integer = 0

    Private cur1 As Integer = 0
    Private tot1 As Integer = 0


    Private ssql As String
    Private eid As String
    Private emailid As String
    Private msg As String
    Private msg1 As String
    Private mplan As String
    Private mdstart As String
    Private mdend As String

    Private CATEDT As String


    Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load


        '============================================
        con = New Odbc.OdbcConnection(ConfigurationManager.ConnectionStrings("connection").ToString())

        If con.State = ConnectionState.Closed Then

            con.Open()

        End If

        ssql = "select * from member where mid=" & Request.QueryString("mid")
        'ssql = "select * from member where uname='" & Request.QueryString("us") & "'"

        dadd = New Odbc.OdbcDataAdapter(ssql, con)
        ds = New DataSet()
        dadd.Fill(ds, "member")
        dt = ds.Tables("member")



        '   Response.Write(ssql)

        emailid = dt.Rows(0)("email").ToString()
        ' emailid = "websoftkota@gmail.com"
        eid = dt.Rows(0)("uname").ToString()


        mplan = dt.Rows(0)("mplan").ToString()
        mdstart = dt.Rows(0)("x").ToString()
        mdend = dt.Rows(0)("z").ToString()
        ' Response.Write(eid)
        '============================================
        CATEDT = "<br><b>Your are listed in</b> <br>"
        ssql = "select * from memberdetail,catedetail where  memberdetail.catdid=catedetail.catdid and memberdetail.mid=" & Request.QueryString("mid")
        ''ssql = "select * from member where uname='" & Request.QueryString("us") & "'"

        'dadd1 = New Odbc.OdbcDataAdapter(ssql, con)
        'ds1 = New DataSet()
        'dadd1.Fill(ds, "memberdetail")
        'dt1 = ds1.Tables("memberdetail")

        'tot1 = dt1.Rows.Count
        'cur = 0
        '
        'While cur1 < tot1

        '    CATEDT = CATEDT + dt.Rows(0)("cdname").ToString()

        '    CATEDT = CATEDT + ", "
        'End While

        cmd = New Odbc.OdbcCommand(ssql, con)

        dr = cmd.ExecuteReader
        If dr.HasRows Then
            While dr.Read()
                CATEDT = CATEDT + dr.Item("cdname")

                CATEDT = CATEDT + ", "
            End While
        End If
        dr.Close()

        '=========================================================================================================
        msg = "We thank you and appreciate you keen interest to explore the tremendous opportunity that exists in our online business directory. We are happy  to provide you with an unmatched online marketing. Which  is always at your service for all your searching need in addition your business."
        msg1 = "<br><br>Once again, we thank you for allowing us to serve you as our customer. <br>We look forward to serving you <br><br> <b>LOOK8US </b>"

        Dim mail As New MailMessage()
        Dim bd As String


        Dim ma = New MailAddress("support@look8us.com")
        mail.From = ma


        mail.To.Add(emailid)
        mail.CC.Add("nagarsanjay83@yahoo.com")
        mail.Bcc.Add("websoftkota@gmail.com")

        mail.Subject = "Welcome at Look8us.com Membership "

        mail.IsBodyHtml = True

        bd = "<b>Dear Member,  :<br><br>  Congrates ! ,</b>Your ID Genrate successfilly.<br><br>" + msg.ToString + " <br><br>Please find Your login detail : <br><br><b>User/Mail ID : </b>" + emailid.ToString + " <br><b>Member ID : </b>" + eid.ToString + " <br><b>Password : </b>" + Request.QueryString("pass").ToString + " <br><b>Your Member Plan : </b>" + mplan.ToString + " <br><b>Your Plan Start : </b>" + mdstart.ToString + " <br><b>Your Plan Expire: </b>" + mdend.ToString + CATEDT.ToString + msg1.ToString
        ' bd = "<b>Dear Member,  :<br><br>  Congrates ! ,</b>Your ID Genrate successfilly. <br>Please find Your login detail : <br><br><b>User/Mail ID : </b>" + emailid

        mail.Body = bd

        mail.Headers.Add("Reply-To", "support@look8us.com")


        Try

            Dim smtpMailObj = New SmtpClient("69.175.7.170", 25)
            'eg:localhost, 192.168.0.x, replace with your server name

            ' smtpMailObj.Host = "jhalawar.net"

            smtpMailObj.DeliveryMethod = Net.Mail.SmtpDeliveryMethod.Network
            ' smtpMailObj.Credentials = New System.Net.NetworkCredential("info@jyotishupay.com", "*akc123")
            smtpMailObj.Credentials = New System.Net.NetworkCredential("enq@jyotishupay.com", "*Akc123")




            smtpMailObj.Send(mail)

            Response.Write("hi")

            'Response.Redirect("user/home.php")
            Response.Redirect("admin/viewMember.php?msg=1")
            '   Response.Write(subj)
            Response.Write(bd)

        Catch

            ' Response.Write("Message Delivery Fails")

        End Try


    End Sub
End Class
